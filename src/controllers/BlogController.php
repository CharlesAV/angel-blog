<?php namespace Angel\Blog;

use App, View;

class BlogController extends \Angel\Core\AngelController {
	
	public function __construct()
	{
		$this->Blog = $this->data['Blog'] = App::make('Blog');

		parent::__construct();
	}
	
	function index()
	{
		// Query
		$objects = $this->Blog
			->orderBy('created_at','desc');
			
		// Pagination
		$paginator = $objects->paginate(5);
		$this->data['blog_entries'] = $paginator->getCollection();
		$appends = $_GET;
		unset($appends['page']);
		$this->data['links'] = $paginator->appends($appends)->links();
			
		// Return
		return View::make('blog::blog.index',$this->data);
	}

	public function show($slug)
	{
		// Item
		$blog_entry = $this->Blog
			->with('comments')
			->where('slug', $slug)
			->first();
		if (!$blog_entry || !$blog_entry->is_published()) App::abort(404);
		$this->data['blog_entry'] = $blog_entry;
		$this->data['time'] = strtotime($blog_entry->created_at);
		
		// Return
		return View::make('blog::blog.show', $this->data);
	}

	public function show_language($language_uri = 'en', $slug)
	{
		// Language
		$language = $this->languages->filter(function ($language) use ($language_uri) {
			return ($language->uri == $language_uri);
		})->first();
		if (!$language) App::abort(404);

		//  Item
		$blog_entry = $this->Blog
			->with('comments')
			->where('language_id', $language->id)
			->where('slug', $slug)
			->first();
		if (!$blog_entry || !$blog_entry->is_published()) App::abort(404);
		$this->data['active_language'] = $language;
		$this->data['blog_entry'] = $blog_entry;
		$this->data['time'] = strtotime($blog_entry->created_at);

		// Return
		return View::make('faqs::faqs.show', $this->data);
	}
	
	function archive($year,$month)
	{
		// Year / month
		$this->data['year'] = $year;
		$this->data['month'] = $month;
		
		// Start / end
		$carbon = \Carbon\Carbon::create($year,$month,1,0,0,0);
		$start = $carbon->toDateTimeString();
		$this->data['month_string'] = date('F',$carbon->timestamp);
		$carbon = \Carbon\Carbon::create($year,($month + 1),1,0,0,0);
		$end = $carbon->toDateTimeString();
		
		// Query
		$objects = $this->Blog
			->where('created_at','>',$start)
			->where('created_at','<',$end)
			->orderBy('created_at','desc');
			
		// Pagination
		$paginator = $objects->paginate(5);
		$this->data['blog_entries'] = $paginator->getCollection();
		$appends = $_GET;
		unset($appends['page']);
		$this->data['links'] = $paginator->appends($appends)->links();
			
		// Return
		return View::make('blog::blog.archive',$this->data);
	}
}
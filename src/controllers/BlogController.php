<?php namespace Angel\Blog;

use App, View, Response;

class BlogController extends \Angel\Core\AngelController {

	public function show($slug,$id)
	{
		$Blog = App::make('Blog');

		$blog = $Blog::find($id);

		if (!$blog || !$blog->is_published()) App::abort(404);

		$this->data['blog'] = $blog;
		$this->data['time'] = strtotime($blog->created_at);

		return View::make('blog::blog', $this->data);
	}

	/*public function show_language($language_uri = 'en', $url = 'home', $section = null)
	{
		$Page = App::make('Page');

		$language = $this->languages->filter(function ($language) use ($language_uri) {
			return ($language->uri == $language_uri);
		})->first();

		if (!$language) App::abort(404);

		$page = $Page::with('modules')
						  ->where('language_id', $language->id)
			              ->where('url', $url)
					      ->first();

		if (!$page || !$page->is_published()) App::abort(404);

		$this->data['active_language']  = $language;
		$this->data['page']				= $page;

		$method = str_replace('-', '_', $url);
		if (method_exists($this, $method)) {
			return $this->$method($section);
		}

		return View::make('core::page', $this->data);
	}*/
	
	function archive($year,$month) {
		// Year / month
		$this->data['year'] = $year;
		$this->data['month'] = $month;
		
		// Start / end
		$carbon = \Carbon\Carbon::create($year,$month,1,0,0,0);
		$start = $carbon->toDateTimeString();
		$this->data['month_string'] = date('F',$carbon->timestamp);
		$carbon = \Carbon\Carbon::create($year,($month + 1),1,0,0,0);
		$end = $carbon->toDateTimeString();
		
		// Blogs
		$Blog = $this->data['model'] = App::make('Blog');
		$this->data['blogs'] = $Blog
			->where('created_at','>',$start)
			->where('created_at','<',$end)
			->orderBy('created_at','desc')
			->get();
			
		// Return
		return View::make('blog::archive',$this->data);
	}
}
<?php namespace Angel\Blog;

use App, View, Response, Config;

class BlogController extends \Angel\Core\AngelController {
	protected $package = 'blog';
	public function __construct() {
		// Config
		foreach(Config::get($this->package.'::config') as $k => $v) {
			$this->$k = $this->data[$k] = $v;
		}
		
		// Model
		$this->model = $this->data['model'] = App::make($this->Model);
		
		// Parent
		parent::__construct();
	}
	
	function index() {
		// Query
		$objects = $this->model
			->orderBy('created_at','desc');
			
		// Pagination
		$paginator = $objects->paginate(5);
		$this->data['items'] = $paginator->getCollection();
		$appends = $_GET;
		unset($appends['page']);
		$this->data['links'] = $paginator->appends($appends)->links();
			
		// Return
		return View::make($this->package.'::'.$this->code.'.index',$this->data);
	}

	public function show($slug,$id)
	{
		// Item
		$item = $this->model->find($id);
		if (!$item || !$item->is_published()) App::abort(404);
		$this->data['item'] = $item;
		$this->data['time'] = strtotime($item->created_at);
		
		// Comments
		$this->data['comments'] = $this->model->comments();
		
		// Return
		return View::make('blog::blog.show', $this->data);
	}
	
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
		
		// Query
		$objects = $this->model
			->where('created_at','>',$start)
			->where('created_at','<',$end)
			->orderBy('created_at','desc');
			
		// Pagination
		$paginator = $objects->paginate(5);
		$this->data['items'] = $paginator->getCollection();
		$appends = $_GET;
		unset($appends['page']);
		$this->data['links'] = $paginator->appends($appends)->links();
			
		// Return
		return View::make('blog::blog.archive',$this->data);
	}
}
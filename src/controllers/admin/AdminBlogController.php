<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;
use App, View;

class AdminBlogController extends AdminCrudController {

	protected $Model	= 'Blog';
	protected $uri		= 'blog';
	protected $plural	= 'blog_entries';
	protected $singular	= 'blog_entry';
	protected $package	= 'blog';

	public function edit($id)
	{
		$Blog = App::make($this->Model);

		$blog_entry = $Blog::withTrashed()->find($id);
		$this->data['blog_entry'] = $blog_entry;
		$this->data['changes'] = $blog_entry->changes();
		$this->data['action'] = 'edit';

		return View::make($this->view('add-or-edit'), $this->data);
	}
}
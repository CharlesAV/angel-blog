<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;
use App, Redirect, Input;

class AdminBlogCommentController extends AdminCrudController {

	protected $package = 'blog';
	protected $Model   = 'BlogComment';
	
	public function add_redirect($object)
	{
		$Model = App::make('Blog');
		$blog = $Model->find($object->blog_id);
		return Redirect::to($blog->link())->with('success', '
			<p>Comment successfully posted.</p>
		');
	}

	public function uri($append = '', $url = false)
	{
		if($blog_id = Input::get('blog_id')) {
			$Blog = App::make('Blog');
			$blog_entry = $Blog->find($blog_id);
			return $blog_entry->link();
		}
	}
}
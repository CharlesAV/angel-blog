<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;
use App, Redirect;

class AdminBlogCommentController extends AdminCrudController {
	protected $package = 'blog';
	protected $Model = 'BlogComment';
	
	public function store(){
		return parent::attempt_add();	
	}
	
	public function add_redirect($object) {
		$Model = App::make('Blog');
		$blog = $Model->find($object->blog_id);
		return Redirect::to($blog->link())->with('success', '
			<p>Comment successfully posted.</p>
		');
	}
}
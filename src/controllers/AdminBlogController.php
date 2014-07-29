<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;

class AdminBlogController extends AdminCrudController {

	protected $Model	= 'Blog';
	protected $uri		= 'blog';
	protected $plural	= 'blog enries';
	protected $singular	= 'blog entry';
	protected $package	= 'blog';

	protected $searchable = array(
		'name',
		'html'
	);

	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required'
		);
	}

}
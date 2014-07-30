<?php namespace Angel\Blog;

use Eloquent;

class BlogComment extends Eloquent {
	protected $table = 'blog_comments';
	protected $softDelete = true;
}
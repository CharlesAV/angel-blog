<?php namespace Angel\Blog;

use Eloquent;

class BlogComment extends Eloquent {

	protected $table = 'blogs_comments';
	
	public function user()
	{
        return $this->belongsTo('User');
    }
}
<?php namespace Angel\Blog;

use Eloquent;

class BlogComment extends Eloquent {
	protected $table = 'blogs_comments';
	public static function columns() {
		return array(   
			'blog_id',
			'user_id',
			'user_name',
			'user_email',
			'text'
		);
	}
	
	public function user() {
        return $this->belongsTo('User');
    }
}
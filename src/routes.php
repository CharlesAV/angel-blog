<?php

Route::group(array('prefix' => 'blog'), function() {

	$controller = 'BlogController';

	Route::get('/', $controller . '@index');
	Route::get('{slug}', $controller . '@show');
	Route::get('archive/{year}/{month}', $controller . '@archive');
	Route::post('comments',array(
		'before' => 'csrf',
		'uses' => 'AdminBlogCommentController@attempt_add'
	));
});

Route::group(array('prefix' => admin_uri('blog'), 'before' => 'admin'), function() {

	$controller = 'AdminBlogController';

	Route::get('/', $controller . '@index');
	Route::get('add', $controller . '@add');
	Route::post('add', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_add'
	));
	Route::get('edit/{id}', $controller . '@edit');
	Route::post('edit/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_edit'
	));
	Route::post('delete/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@delete'
	));
});
<?php
Route::get('blog','BlogController@index');
Route::get('blog/{slug}','BlogController@show');
Route::get('blog/archive/{year}/{month}','BlogController@archive');  

Route::group(array('prefix'=>admin_uri('blog'), 'before'=>'admin'), function() {

	$controller = 'AdminBlogController';

	Route::get('/', array(
		'uses' => $controller . '@index'
	));
	Route::get('add', array(
		'uses' => $controller . '@add'
	));
	Route::post('add', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_add'
	));
	Route::get('edit/{id}', array(
		'uses' => $controller . '@edit'
	));
	Route::post('edit/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_edit'
	));
	Route::post('delete/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@delete'
	));
});

// Comments
Route::post('blog/comments',array(
	'before' => 'csrf',
	'uses' => 'AdminBlogCommentController@attempt_add'
));
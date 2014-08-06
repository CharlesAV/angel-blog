<?php namespace Angel\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('angel/blog');
		
		include __DIR__ . '../../../routes.php';

		$bindings = array(
			// Models
			'Blog'        => '\Angel\Blog\Blog',
			'BlogComment' => '\Angel\Blog\BlogComment',
	
			// Controllers
			'BlogController'             => '\Angel\Blog\BlogController',
			'AdminBlogController'        => '\Angel\Blog\AdminBlogController',
			'AdminBlogCommentController' => '\Angel\Blog\AdminBlogCommentController'
		);
		
		foreach ($bindings as $name=>$class) {
			$this->app->singleton($name, function() use ($class) {
				return new $class;
			});
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

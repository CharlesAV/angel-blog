<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;
use App, Input, View, Config;

class AdminBlogController extends AdminCrudController {

	protected $Model	= 'Blog';
	protected $uri		= 'blog';
	protected $plural	= 'blog_entries';
	protected $singular	= 'blog_entry';
	protected $package	= 'blog';

	protected $log_changes = true;
	protected $searchable = array(
		'name',
		'slug',
		'html'
	);

	// Columns to update on edit/add
	protected static function columns()
	{
		$columns = array(
			'name',
			'slug',
			'html',
			'title',
			'meta_description',
			'meta_keywords',
			'og_type',
			'og_image',
			'twitter_card',
			'twitter_image',
			'published',
			'published_range',
			'published_start',
			'published_end'
		);
		if (Config::get('core::languages')) $columns[] = 'language_id';
		return $columns;
	}
	
	public function after_save($blog_entry, &$changes = array())
	{
		$blog_entry->plaintext = strip_tags($blog_entry->html);
		$blog_entry->save();
	}

	public function edit($id)
	{
		$Blog = App::make($this->Model);

		$blog_entry = $Blog::withTrashed()->find($id);
		$this->data['blog_entry'] = $blog_entry;
		$this->data['changes'] = $blog_entry->changes();
		$this->data['action'] = 'edit';

		return View::make($this->view('add-or-edit'), $this->data);
	}

	/**
	 * @param int $id - The ID of the model when editing, null when adding.
	 * @return array - Rules for the validator.
	 */
	public function validate_rules($id = null)
	{
		return array(
			'name' => 'required',
			'slug' => 'required|alpha_dash|unique:blogs,slug,' . $id
		);
	}

	/**
	 * @param array &$errors - The array of failed validation errors.
	 * @return array - A key/value associative array of custom values.
	 */
	public function validate_custom($id = null, &$errors)
	{
		$published_start = Input::get('published_start');
		$published_end   = Input::get('published_end');
		if (Input::get('published_range') && $published_end && strtotime($published_start) >= strtotime($published_end)) {
			$errors[] = 'The publication end time must come after the start time.';
		} else if (!Input::get('published_range')) {
			// Reset these so that we won't ever get snagged by an impossible range
			// if the user has collapsed the publication range expander.
			$published_start = $published_end = 0;
		}

		return array(
			'title'           => Input::get('title') ? Input::get('title') : Input::get('name'),
			'published'       => Input::get('published') ? 1 : 0,
			'published_range' => Input::get('published_range') ? 1 : 0,
			'published_start' => $published_start,
			'published_end'   => $published_end
		);
	}
}
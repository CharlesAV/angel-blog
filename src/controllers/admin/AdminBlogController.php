<?php namespace Angel\Blog;

use Angel\Core\AdminCrudController;
use App, Input, View, Validator;

class AdminBlogController extends AdminCrudController {

	protected $Model	= 'Blog';
	protected $uri		= 'blog';
	protected $plural	= 'blogs';
	protected $singular	= 'blog';
	protected $package	= 'blog';

	protected $log_changes = true;
	protected $searchable = array(
		'name',
		'slug',
		'html'
	);
	
	public function after_save($blog, &$changes = array())
	{
		$blog->plaintext = strip_tags($blog->html);
		$blog->save();
	}

	public function edit($id)
	{
		$Blog = App::make('Blog');

		$blog = $Blog::withTrashed()->find($id);
		$this->data['blog'] = $blog;
		$this->data['changes'] = $blog->changes();
		$this->data['action'] = 'edit';

		return View::make($this->package . '::admin.blog.add-or-edit', $this->data);
	}
	
	

	/**
	 * Validate all input when adding or editing a blog entry.
	 *
	 * @param array &$custom - This array is initialized by this function.  Its purpose is to
	 * 							exclude certain columns that require intervention of some kind (such as
	 * 							checkboxes because they aren't included in input on submission)
	 * @param int $id - (Optional) ID of blog entry beind edited
	 * @return array - An array of error messages to show why validation failed
	 */
	public function validate(&$custom, $id = null)
	{
		$errors = array();
		$rules = array(
			'name' => 'required',
			'slug' => 'alpha_dash'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			foreach($validator->messages()->all() as $error) {
				$errors[] = $error;
			}
		}

		$published_start = Input::get('published_start');
		$published_end = Input::get('published_end');
		if (Input::get('published_range') && $published_end && strtotime($published_start) >= strtotime($published_end)) {
			$errors[] = 'The publication end time must come after the start time.';
		} else if (!Input::get('published_range')) {
			// Reset these so that we won't ever get snagged by an impossible range
			// if the user has collapsed the publication range expander.
			$published_start = $published_end = 0;
		}

		$custom = array(
			'title'           => Input::get('title') ? Input::get('title') : Input::get('name'),
			'published'       => Input::get('published') ? 1 : 0,
			'published_range' => Input::get('published_range') ? 1 : 0,
			'published_start' => $published_start,
			'published_end'   => $published_end
		);

		return $errors;
	}

}
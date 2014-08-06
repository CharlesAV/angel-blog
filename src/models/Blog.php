<?php namespace Angel\Blog;

use Angel\Core\LinkableModel;
use App, Config;

class Blog extends LinkableModel {

	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	public function changes()
	{
		$Change = App::make('Change');

		return $Change::where('fmodel', 'Blog')
				   	       ->where('fid', $this->id)
				   	       ->with('user')
				   	       ->orderBy('created_at', 'DESC')
				   	       ->get();
	}
	public function comments()
	{
		return $this->hasMany(App::make('BlogComment'))->orderBy('created_at','desc');
	}

	// Handling relationships in controller CRUD methods
	public function pre_delete()
	{
		parent::pre_delete();
		$Change = App::make('Change');
		$Change::where('fmodel', 'Blog')
			        ->where('fid', $this->id)
			        ->delete();
	}

	///////////////////////////////////////////////
	//               Menu Linkable               //
	///////////////////////////////////////////////
	// Menu link related methods - all menu-linkable models must have these
	// NOTE: Always pull models with their languages initially if you plan on using these!
	// Otherwise, you're going to be performing repeated queries.  Naughty.
	public function link()
	{
		$language_segment = (Config::get('core::languages')) ? $this->language->uri . '/' : '';

		return url($language_segment . 'blog/' . $this->slug);
	}
	public function link_edit()
	{
		return admin_url('blog/edit/' . $this->id);
	}
                                   
	///////////////////////////////////////////////
	//                View-Related               //
	///////////////////////////////////////////////
	public function meta_html()
	{
		$html = '';
		if ($this->title) {
			$html .= '<meta name="og:title" content="' . $this->title . '" />' . "\n";
			$html .= '<meta name="twitter:title" content="' . $this->title . '" />' . "\n";
		}
		if ($this->meta_description) {
			$html .= '<meta name="description" content="' . $this->meta_description . '" />' . "\n";
			$html .= '<meta name="og:description" content="' . $this->meta_description . '" />' . "\n";
			$html .= '<meta name="twitter:description" content="' . $this->meta_description . '" />' . "\n";
		}
		if ($this->meta_keywords) {
			$html .= '<meta name="keywords" content="' . $this->meta_keywords . '" />' . "\n";
		}
		if ($this->url) {
			$html .= '<meta name="og:url" content="' . $this->link() . '" />' . "\n";
			$html .= '<meta name="twitter:url" content="' . $this->link() . '" />' . "\n";
		}
		if ($this->og_type) {
			$html .= '<meta name="og:type" content="' . $this->og_type . '" />' . "\n";
		}
		if ($this->og_image) {
			$html .= '<meta name="og:image" content="' . $this->og_image . '" />' . "\n";
		}
		if ($this->twitter_card) {
			$html .= '<meta name="twitter:card" content="' . $this->twitter_card . '" />' . "\n";
		}
		if ($this->twitter_image) {
			$html .= '<meta name="twitter:image" content="' . $this->twitter_image . '" />' . "\n";
		}
		return $html;
	}

	public function is_published()
	{
		if ((
				$this->published_range &&
				(strtotime($this->published_start) > time() || strtotime($this->published_end) < time())
			) || (
				!$this->published_range &&
				!$this->published
			)) return false;
		return true;
	}
	
	public function recent($count = 5)
	{
		$blog_entries = $this->orderBy('created_at','desc')->limit($count)->get();
		
		return $blog_entries;
	}
	
	public function archive()
	{
		$array = array();
		$blog_entries = $this->orderBy('id','desc')->get();
		foreach($blog_entries as $blog_entry) {
			$time = strtotime($blog_entry->created_at);
			$year = date('Y',$time);
			$month = date('m',$time);
			$key = $year.$month;
			if(!isset($array[$key])) {
				$array[$key] = array(
					'year' => $year,
					'month' => date('F',$time),
					'time' => strtotime($month."/1/".$year),
					'count' => 1,
					'url' => url('blog/archive/'.$year.'/'.$month)
				);
			}
			else $array[$key]['count'] += 1;
		}
		
		// Return
		return $array;
	}
}
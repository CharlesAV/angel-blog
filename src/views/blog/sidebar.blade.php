<div class="blog-recent">
	{{ View::make('blog::blog.sidebar.recent',array('model' => $model)) }}
</div>
<div class="blog-archive">
	{{ View::make('blog::blog.sidebar.archive',array('model' => $model)) }}
</div>
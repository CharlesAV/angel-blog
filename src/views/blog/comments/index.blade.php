<h2>Comments ({{ $blog_entry->comments->count() }})</h2>

{{ Form::open(array('role' => 'form', 'url' => url('blog/comments'))) }}
	{{ Form::hidden('blog_id',$blog_entry->id); }}

	<div class="blog-comments-form">
		@if(!Auth::check())
		<div class="form-group blog-comments-form-user_name">
				{{ Form::text('user_name', null, array('class' => 'form-control','placeholder' => 'Name', 'required')) }}
		</div>
		<div class="form-group blog-comments-form-user_email">
			{{ Form::text('user_email', null, array('class' => 'form-control','placeholder' => 'E-mail', 'required')) }}
		</div>
		@else
			{{ Form::hidden('user_id', Auth::user()->id) }}
		@endif
		<div class="form-group blog-comments-form-text">
			{{ Form::textarea('text', null, array('class' => 'form-control','placeholder' => 'Comment', 'required')) }}
		</div>
		<div class="blog-comments-form-submit">
			<input type="submit" class="btn btn-primary" value="Submit" />
		</div>
	</div>
{{ Form::close() }}
<br />
@if($blog_entry->comments->count())
	<table class="table table-striped table-bordered">
		@foreach($blog_entry->comments->get() as $comment)
			@include('blog::blog.comments.show')
		@endforeach
	</table>
@else 
	No comments yet
@endif
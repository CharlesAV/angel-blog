<h2>Comments ({{ $comments->count() }})</h2>

{{ Form::open(array('role' => 'form', 'url' => url('blog/comments'), 'method'=>'post')) }}
{{ Form::hidden('blog_id',$item->id); }}

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

@if($comments->count()) 
<table class="table table-striped table-bordered">
	@foreach($comments->get() as $comment)
		{{ View::make('blog::blog.comments.show',array('item' => $comment)) }}
	@endforeach
</table>
@else 
	No comments yet
@endif
<h2>Comments</h2>

{{ Form::open(array('role' => 'form', 'url' => url('blog/comments'), 'method'=>'post')) }}
{{ Form::hidden('blog_id',$item->id); }}

@if(0)
	{{ Form::text('name', null, array('placeholder' => 'Name', 'required')) }}
	{{ Form::text('name', null, array('placeholder' => 'E-mail', 'required')) }}
@endif
{{ Form::textarea('text', null, array('placeholder' => 'Comment', 'required')) }}
<input type="submit" class="btn btn-primary" value="Submit" />
{{ Form::close() }}

@if(count($comments)) 
	@foreach($comments as $comment)
		{{ View::make('blog::blog.comments.show',array('item' => $comment)) }}
	@endforeach
@else 
	No comments yet
@endif
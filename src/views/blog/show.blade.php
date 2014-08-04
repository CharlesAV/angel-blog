@extends('core::template')

@section('title', $item->title)

@section('meta')
	{{ $item->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1 class="blog-name">{{ $item->name }}</h1>
			<div class="blog-date">Posted {{ date('F j, Y',strtotime($item->created_at)) }} at {{ date('g:i A',strtotime($item->created_at)) }}</div>
			<div class="blog-html">
				{{ $item->html }}
			</div>
			
			<div class="blog-comments">
				{{ View::make('blog::blog.comments.index',array('item' => $item,'model' => $model,'comments' => $comments)) }}
			</div>
		</div>
		<div class="col-md-3">
			{{ View::make('blog::blog.sidebar',array('model' => $model)) }}
		</div>
	</div>
@stop
@extends('core::template')

@section('title', $blog_entry->title)

@section('meta')
	{{ $blog_entry->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1 class="blog-name">{{ $blog_entry->name }}</h1>
			<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog_entry->created_at)) }} at {{ date('g:i A',strtotime($blog_entry->created_at)) }}</div>
			<div class="blog-html">
				{{ $blog_entry->html }}
			</div>
			<div class="blog-comments">
				{{ View::make('blog::blog.comments.index',array('blog_entry' => $blog_entry,'Blog' => $Blog,'comments' => $comments)) }}
			</div>
		</div>
		<div class="col-md-3">
			{{ View::make('blog::blog.sidebar',array('Blog' => $Blog)) }}
		</div>
	</div>
@stop
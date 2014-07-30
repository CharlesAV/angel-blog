@extends('core::template')

@section('title', $blog->title)

@section('meta')
	{{ $blog->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1 class="blog-name">{{ $blog->name }}</h1>
			<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog->created_at)) }} at {{ date('g:i A',strtotime($blog->created_at)) }}</div>
			<div class="blog-html">
				{{ $blog->html }}
			</div>
		</div>
		<div class="col-md-3">
			<div class="blog-recent">
				{{ View::make('blog::sidebar.recent',array('blog' => $blog)) }}
			</div>
			<div class="blog-archive">
				{{ View::make('blog::sidebar.archive',array('blog' => $blog)) }}
			</div>
		</div>
	</div>
@stop
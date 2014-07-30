@extends('core::template')

@section('title')
{{ $month_string }} {{ $year }} | Blog Archive
@stop

@section('meta')
	{{ $model->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1 class="blog-archive-heading">{{ $month_string }} {{ $year }}</h1>
			@foreach($blogs as $blog) 
			<div class="blog-archive-item">
				<h2 class="blog-name"><a href="{{ $blog->link() }}">{{ $blog->name }}</a></h2>
				<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog->created_at)) }} at {{ date('g:i A',strtotime($blog->created_at)) }}</div>
				<div class="blog-html">
					{{ $blog->html }}
				</div>
			</div>
			@endforeach
		</div>
		<div class="col-md-3">
			<div class="blog-recent">
				{{ View::make('blog::sidebar.recent',array('blog' => $model)) }}
			</div>
			<div class="blog-archive">
				{{ View::make('blog::sidebar.archive',array('blog' => $model)) }}
			</div>
		</div>
	</div>
@stop
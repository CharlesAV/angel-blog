@extends('core::template')

@section('title')
{{ $month_string }} {{ $year }} | Blog Archive
@stop

@section('meta')
	{{ $Blog->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1 class="blog-archive-heading">{{ $month_string }} {{ $year }}</h1>
			@foreach($blog_entries as $blog_entry) 
			<div class="blog-archive-blog_entry">
				<h2 class="blog-name"><a href="{{ $blog_entry->link() }}">{{ $blog_entry->name }}</a></h2>
				<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog_entry->created_at)) }}</div>
				<div class="blog-html">
					{{ $blog_entry->html }}
				</div>
			</div>
			@endforeach
			
			<div class="row text-center">
				{{ $links }}
			</div>
		</div>
		<div class="col-md-3">
			@include('blog::blog.sidebar')
		</div>
	</div>
@stop
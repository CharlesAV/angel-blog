@extends('core::template')

@section('title','Blog')

@section('content')
	<div class="row">
		<div class="col-md-9">
			@foreach($blog_entries as $blog_entry) 
			<div class="blog-item">
				<h1 class="blog-name"><a href="{{ $blog_entry->link() }}">{{ $blog_entry->name }}</a></h1>
				<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog_entry->created_at)) }} at {{ date('g:i A',strtotime($blog_entry->created_at)) }}</div>
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
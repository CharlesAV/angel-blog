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
			@foreach($items as $item) 
			<div class="blog-archive-item">
				<h2 class="blog-name"><a href="{{ $item->link() }}">{{ $item->name }}</a></h2>
				<div class="blog-date">Posted {{ date('F j, Y',strtotime($item->created_at)) }} at {{ date('g:i A',strtotime($item->created_at)) }}</div>
				<div class="blog-html">
					{{ $item->html }}
				</div>
			</div>
			@endforeach
			
			<div class="row text-center">
				{{ $links }}
			</div>
		</div>
		<div class="col-md-3">
			{{ View::make('blog::blog.sidebar',array('model' => $model)) }}
		</div>
	</div>
@stop
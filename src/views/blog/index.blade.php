@extends('core::template')

@section('title','Blog')

@section('meta')
	{{ $model->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			@foreach($items as $item) 
			<div class="blog-item">
				<h1 class="blog-name"><a href="{{ $item->link() }}">{{ $item->name }}</a></h1>
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
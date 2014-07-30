@extends('core::template')

@section('title','Blog')

@section('meta')
	{{ $model->meta_html() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			@foreach($blogs as $blog) 
			<div class="blog-item">
				<h1 class="blog-name"><a href="{{ $blog->link() }}">{{ $blog->name }}</a></h1>
				<div class="blog-date">Posted {{ date('F j, Y',strtotime($blog->created_at)) }} at {{ date('g:i A',strtotime($blog->created_at)) }}</div>
				<div class="blog-html">
					{{ $blog->html }}
				</div>
			</div>
			@endforeach
			
			<div class="row text-center">
				{{ $links }}
			</div>
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
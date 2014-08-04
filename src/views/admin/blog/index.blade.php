@extends('core::admin.template')

@section('title', 'Blog')

@section('content')
	<div class="row pad">
		<div class="col-sm-8 pad">
			<h1>Blog</h1>
			<a class="btn btn-sm btn-primary" href="{{ admin_url('blog/add') }}">
				<span class="glyphicon glyphicon-plus"></span>
				Add
			</a>
		</div>
		<div class="col-sm-4 well">
			{{ Form::open(array('role'=>'form', 'method'=>'get')) }}
				<div class="form-group">
					<label>Search</label>
					<input type="text" name="search" class="form-control" value="{{ $search }}" />
				</div>
				<div class="text-right">
					<input type="submit" class="btn btn-primary" value="Search" />
				</div>
			{{ Form::close() }}
		</div>
	</div>
	<div class="row text-center">
		{{ $links }}
	</div>
	@if (Config::get('core::languages') && !$single_language)
		{{ Form::open(array('url'=>admin_uri('blog/copy'), 'role'=>'form', 'class'=>'noSubmitOnEnter')) }}
	@endif

	<div class="row">
		<div class="col-sm-9">
			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width:80px;"></th>
						@if (Config::get('core::languages') && !$single_language)
							<th style="width:60px;">Copy</th>
						@endif
						<th style="width:80px;">ID</th>
						<th>Name</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
				@if(count($items))
					@foreach ($items as $item)
					<tr{{ $item->deleted_at ? ' class="deleted"' : '' }}>
						<td>
							<a href="{{ $item->link_edit() }}" class="btn btn-xs btn-default">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							@if (!$item->deleted_at)
								<a href="{{ $item->link() }}" class="btn btn-xs btn-info" target="_blank">
									<span class="glyphicon glyphicon-eye-open"></span>
								</a>
							@endif
						</td>
						<td>{{ $item->id }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->title }}</td>
					</tr>
					@endforeach
				@else 
					<tr>
						<td colspan="4" align="center">
							No {{ Config::get($package."::plural") }} Found.
						</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="row text-center">
		{{ $links }}
	</div>
@stop
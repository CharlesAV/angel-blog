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
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
				@if(count($blog_entries))
					@foreach ($blog_entries as $blog_entry)
						<tr>
							<td>
								<a href="{{ $blog_entry->link_edit() }}" class="btn btn-xs btn-default">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
								<a href="{{ $blog_entry->link() }}" class="btn btn-xs btn-info" target="_blank">
									<span class="glyphicon glyphicon-eye-open"></span>
								</a>
							</td>
						@if (Config::get('core::languages') && !$single_language)
							<td>{{ Form::checkbox('ids[]', $blog_entry->id, false, array('class'=>'idCheckbox')) }}</td>
						@endif
							<td>{{ $blog_entry->name }}</td>
						</tr>
					@endforeach
				@else 
					<tr>
						<td colspan="4" align="center">
							<br />
							No Blog Entries Found.<br /><br />	
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
	@if (Config::get('core::languages') && !$single_language)
		<div class="row pad">
			{{ Form::hidden('all', 0, array('id'=>'all')) }}
			<button type="button" id="copyChecked" class="btn btn-sm btn-primary">Copy checked...</button>
			<button type="button" id="copyAll" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#copyModal">Copy all...</button>
		</div>
		<div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Copy to...</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<?php
								$language_drop_minus_active = $language_drop;
								unset($language_drop_minus_active[$active_language->id]);
							?>
							{{ Form::label('language_id', 'Language') }}
							{{ Form::select('language_id', $language_drop_minus_active, $active_language->id, array('class' => 'form-control')) }}
						</div>
						<p class="text-right">
							{{ Form::submit('Done', array('class'=>'btn btn-primary')) }}
						</p>
					</div>{{-- Modal --}}
				</div>{{-- Modal --}}
			</div>{{-- Modal --}}
		</div>{{-- Modal --}}
	{{ Form::close() }}
	@endif
@stop
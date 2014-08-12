<h2>Recent Blog Entries</h2>
@if($blog_entries = $Blog->recent(5))
	<ul>
	@foreach($blog_entries as $blog_entry)
		<li><a href="{{ $blog_entry->link() }}">{{ $blog_entry->name }}</a></li>
	@endforeach
	</ul>
@else 
	No Recent Blog Entries
@endif
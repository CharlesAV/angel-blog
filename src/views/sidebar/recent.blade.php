<h2>Recent Blog Entries</h2>
@if($blogs = $blog->recent(5))
	<ul>
	@foreach($blogs as $blog)
		<li><a href="{{ $blog->link() }}">{{ $blog->name }}</a></li>
	@endforeach
	</ul>
@else 
	No recent blog entries
@endif
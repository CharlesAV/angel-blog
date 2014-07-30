<h2>Archive</h2>
@if($array = $blog->archive())
	<ul>
	@foreach($array as $v)
		<li><a href="{{ $v['url'] }}">{{ $v['month'] }} {{ $v['year'] }} ({{ $v['count'] }})</a></li>
	@endforeach
	</ul>
@else 
	No blog entries found
@endif
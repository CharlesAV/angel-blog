<h2>Recent Blog Entries</h2>
@if($items = $model->recent(5))
	<ul>
	@foreach($items as $item)
		<li><a href="{{ $item->link() }}">{{ $item->name }}</a></li>
	@endforeach
	</ul>
@else 
	No recent blog entries
@endif
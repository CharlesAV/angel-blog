<div class="blog-comment">
	<div class="blog-comment-user">
	@if($item->user_id) 
		{{ Auth::user()->name }}
	@else
		{{ $item->user_name }}
	@endif
	</div>
	<div class="blog-comment-time">
		{{ date('F j, Y g:i A',strtotime($item->created_at)) }}
	</div>
	<div class="blog-comment-text">
		$item->text
	</div>
</div>

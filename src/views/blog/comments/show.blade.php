<tr class="blog-comment">
	<td>
		<div class="blog-comment-user">
		@if($item->user_id) 
			{{ $item->user->first_name." ".$item->user->last_name }}
		@else
			{{ $item->user_name }}
		@endif
		</div>
		<div class="blog-comment-time">
			{{ date('F j, Y g:i A',strtotime($item->created_at)) }}
		</div>
		<div class="blog-comment-text">
			{{ nl2br($item->text) }}
		</div>
	</td>
</tr>

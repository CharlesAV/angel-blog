<tr class="blog-comment">
	<td>
		<div class="blog-comment-user">
		@if($comment->user_id) 
			{{ $comment->user->first_name." ".$comment->user->last_name }}
		@else
			{{ $comment->user_name }}
		@endif
		</div>
		<div class="blog-comment-time">
			{{ date('F j, Y g:i A',strtotime($comment->created_at)) }}
		</div>
		<div class="blog-comment-text">
			{{ nl2br(strip_tags($comment->text)) }}
		</div>
	</td>
</tr>

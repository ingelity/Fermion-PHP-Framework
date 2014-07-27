<?php foreach($comments as $comment): ?>
	<tr class="comment active">
		<td><strong><?php echo $comment['email']; ?></strong><small> said: </small></td>
		<td><?php echo $comment['content']; ?></td>
	</tr>
<?php endforeach; ?>
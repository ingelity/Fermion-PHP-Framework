<?php foreach($posts as $post): ?>
	<tr class="post active" onclick="location.href='/post?id=<?php echo $post['id'] ?>'">
		<td><?php echo $post['title']; ?></td>
		<td><small>written by </small><strong><?php echo $post['email']; ?></strong></td>
	</tr>
<?php endforeach; ?>
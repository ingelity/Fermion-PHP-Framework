<?php if(!empty($post)): ?>
	<h2 class="text-uppercase">
		<?php echo $post['title'] ?>
	</h2>
	<span><em>published on <?php echo $post['date'] ?></em></span>

	<blockquote>
		<p><?php echo $post['content'] ?></p>
		<footer><em>by <strong><?php echo $post['author'] ?></strong></em></footer>
	</blockquote>

	<a class="btn btn-default" href="<?php echo SITE_URL ?>/post-edit/<?php echo $post['slug'] ?>">
		<div class="col-md-3">Edit</div>
	</a>

	<?php if($post['status'] == 'pending'): ?>
		<a class="btn btn-default" href="<?php echo SITE_URL; ?>/post-publish/<?php echo $post['id'] ?>">
			<div class="">Publish</div>
		</a>
	<?php endif; ?>
<?php endif; ?>
<?php include SOURCE_PATH.'captcha.php'; ?>

<form role="form" action="<?php echo BASE_URL; ?>/save_comment" method="post">
	<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
	<div class="form-group">
		<input type="email" name="email" class="form-control required" placeholder="Your email" required>
	</div>
	<div class="form-group">
		<textarea class="form-control" name="content" rows="3" placeholder="Write Your comment on this post here." required></textarea>
	</div>
	<div class="form-group">
		<input name="captcha" type="text" placeholder="Enter captcha code" required>
		<img src="<?php echo BASE_URL; ?>/img/captcha.png" />
	</div>
	<button type="submit" class="btn btn-primary">Submit Comment</button>
</form>
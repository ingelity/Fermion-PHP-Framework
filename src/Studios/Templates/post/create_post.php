<?php \Studios\View::render('header'); ?>

<?php include SOURCE_PATH.'captcha.php'; ?>

<?php \Studios\Router::flash('post_form_error'); ?>
<form role="form" action="<?php echo BASE_URL; ?>/save_post" method="post"> 
	<div class="form-group">
		<input type="text" name="title" class="form-control" placeholder="Post title" required>
	</div>
	<div class="form-group">
		<input type="email" name="email" class="form-control" placeholder="Your email" required>
	</div>
	<div class="form-group">
		<textarea class="form-control" name="content" rows="7" placeholder="Write Your post here." required></textarea>
	</div>
	<div class="form-group">
		<input name="captcha" type="text" placeholder="Enter captcha code" required>
		<img src="<?php echo BASE_URL; ?>/img/captcha.png" />
	</div>
	<button type="submit" class="btn btn-primary">Create</button>
</form>

<?php \Studios\View::render('footer'); ?>
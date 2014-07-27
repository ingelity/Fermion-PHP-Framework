<?php \Studios\View::render('header'); ?>

<h2 class="text-uppercase"><?php echo $post['title'];?></h2>

<blockquote>
	<p><?php echo $post['content']; ?></p>
	<footer><em><?php echo $post['email']; ?></em></footer>
</blockquote>

<?php \Studios\Router::flash('comment_form_error'); ?>

<table id="post_comments" class="table table-striped table-hover">
	<th>Comments on this post:</th>
	<?php \Studios\View::render('partials'.DIRECTORY_SEPARATOR .'comments', array('comments'=>$comments)); ?>
</table>

<script type="text/javascript">
	window.setInterval(function() {
		jQuery.get('<?php echo BASE_URL; ?>/count_comments', {post_id:<?php echo $post['id']; ?>}, function(res){
			var posts_num = jQuery('#post_comments .comment').length;
			if(res > posts_num)
				jQuery("#post_comments").load('<?php echo BASE_URL; ?>/load_comments?post_id=<?php echo $post['id']; ?>');
		});
	}, 5000);
</script>

<?php \Studios\View::render('comment'.DIRECTORY_SEPARATOR .'create_comment', array('post_id'=>$post['id'])); ?>

<?php \Studios\View::render('footer'); ?>
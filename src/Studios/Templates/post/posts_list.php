<?php \Studios\View::render('header'); ?>

<a class="btn btn-default" href="<?php echo BASE_URL; ?>/new_post"><div class="col-xs-6 col-sm-4">Write new post</div></a>
<h2><?php echo $GLOBALS['lang_main']['posts_list_title'];?></h2>

<table id="posts_list" class="table table-striped table-hover">
	<?php \Studios\View::render('partials'.DIRECTORY_SEPARATOR .'posts', array('posts'=>$posts)); ?>
</table>

<script type="text/javascript">
	window.setInterval(function() {
		jQuery.get('<?php echo BASE_URL; ?>/count_posts', function(res){
			var posts_num = jQuery('#posts_list .post').length;
			if(res > posts_num)
				jQuery("#posts_list").load('<?php echo BASE_URL; ?>/load_posts');
		});
	}, 5000);
</script>

<?php \Studios\View::render('footer'); ?>
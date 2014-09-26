/* 
 * Dynamic update of posts via Ajax
 */
/* window.setInterval(function() {	
	
	var countUrl = jQuery('#postsList').data('count-url');
	
	jQuery.get(countUrl, function(res) {
		var posts_num = jQuery('#postsList .post').length;
		// if the number of posts changed
		if(res > posts_num) {
			var loadUrl = jQuery('#postsList').data('load-url');
			// load new posts
			jQuery("#postsList").load(loadUrl);
		}
	});
}, 5000); */
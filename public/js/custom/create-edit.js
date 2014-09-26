jQuery(function() {
	if(window.location.href.indexOf('post-new') > -1 || window.location.href.indexOf('post-edit') > -1) {
		jQuery('#date').datepicker({dateFormat: 'yy-mm-dd'});
	}
});
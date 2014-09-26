/* 
 * Ajax news search
 */
function search() {
	var keystring = jQuery('#search').val();
	var url = jQuery('#search').data('url');
	var csrf = jQuery('#search').data('csrf');
	
	jQuery('#postsList').load(url, {keystring:keystring, csrf:csrf});
}

jQuery(function() {
    
	jQuery('#search').keyup(function(event){
		if(event.keyCode == 13) search();
	});
	
	jQuery('#searchBtn').click(search);
});
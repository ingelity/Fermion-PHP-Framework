<?php 
namespace Studios;

class View{

	/**
	 * Function for rendering templates to the user with passed data.
	 *
	 * @param string
	 * @param array
	 * @return html view
	 */
	public static function render($template, $data=array()){
		extract($data);
		ob_start();
		include TEMPLATES_PATH.$template.'.php';
		echo ob_get_clean();
	}
}
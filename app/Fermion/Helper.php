<?php 
namespace Fermion;

class Helper {

	/** 
	 * Displaying notifications. The message is visible only in the next request and then it's removed.
	 *
	 * @param string $name
	 * @param string $message
	 * @return void
	 */
	public function flash($name='', $message='') {
		
		// display all messages and remove them from session
		if(empty($name)) {
			$msgs = ['success', 'error'];
			foreach($msgs as $msg) {
				if(!empty($_SESSION[$msg])) {
					echo '<div class="alert alert-block alert-'.$msg.'">'.$_SESSION[$msg].'</div>';
					unset($_SESSION[$msg]);
				}
			}
		}
		// if there's a message for saving which is not in session already, place it there
		elseif(!empty($message)) {
			$_SESSION[$name] = $message;
		}
	}
	
	/** 
	 * Make a slug out of a given string
	 *
	 * @param string
	 * @return string
	 */
	public function sluggify($input) {
		// replacing everything which is not a letter or a number with dashes. and if the new string ends with a dash, remove it.
		return preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($input)));
	}
	
	/** 
	 * Generate excerpt from a given string
	 *
	 * @param string
	 * @param integer
	 * @return string
	 */
	public function excerpt($text, $length) {
		if(strlen($text) < $length) return $text;
		return substr($text, 0, $length).'...';
	}
}
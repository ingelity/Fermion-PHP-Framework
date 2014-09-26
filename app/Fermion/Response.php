<?php 
namespace Fermion;

class Response {

	/**
	 * Function for rendering views to the user with passed data, and optionally enclosing the view in layout.
	 *
	 * @param string
	 * @param boolean
	 * @param array
	 * @return html view
	 */
	public function render($view, $enclose=false, $data=[]) {
		
		extract($data);
		ob_start();
		
		if($enclose) include VIEWS_PATH. 'header.php';
		include VIEWS_PATH. $view .'.php';
		if($enclose) include VIEWS_PATH. 'footer.php';
		
		echo ob_get_clean();
	}
	
	/**
	 * Display 404 page
	 *
	 * @param string
	 * @return void
	 */
	public function show_404($msg='') {
		header('HTTP/1.0 404 Not Found');
		$this->render('error/404', true, array('msg'=>$msg));
	}
	
	/**
	 * Display 500 page
	 *
	 * @param string
	 * @return void
	 */
	public function show_500($msg='') {
		header('HTTP/1.0 500 Internal Server Error');
		$this->render('error/500', true, array('msg'=>$msg));
	}
	
	/**
	 * Redirect function
	 *
	 * @param string
	 * @param array
	 * @param integer
	 * @return void
	 */
	public function redirect($path='/', $message=[], $back=false, $params=[], $statusCode=302) {
		
		if(!empty($message)) {
			App::get('helper')->flash($message[0], $message[1]);
		}
		
		// don't use if u want to be absolutely sure about the destination of redirection
		if($back) {
			header('Location: '. App::get('request')->data['HTTP_REFERER'], true, $statusCode);
			exit();
		}
		
		$query = '';
		if(!empty($params)) {
			$query .= '?';
			foreach($params as $key => $param) {
				$query .= $key .'='. urlencode($param) .'&';
			}
			$query = substr($query, 0, strlen($query)-1);
		}
		
		header('Location: '. SITE_URL . $path . $query, true, $statusCode);			
		exit();
	}
}
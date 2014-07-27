<?php
namespace Studios;
use \Studios\Controllers\PostController,
	\Studios\Controllers\CommentController;

class Router{

	public static function route(){
		
		/* list all posts */
		if('/' == $_SERVER['REQUEST_URI'])
			(new PostController())->list_action();	
		
		/* show single post */
		else if('/post' == $_SERVER['PATH_INFO'] && isset($_GET['id']))
			(new PostController())->show_action($_GET['id']);
		
		/* display form for creating a new post */
		else if('/new_post' == $_SERVER['PATH_INFO'])
			View::render('post'.DIRECTORY_SEPARATOR .'create_post');
		
		/* after the form for creating a new post is submitted, validate data and save a new post in the database */
		else if('/save_post' == $_SERVER['PATH_INFO'])
			(new PostController())->save_action();
			
		/* ajax check if the number of posts changed since the page was displayed to the user */
		else if('/count_posts' == $_SERVER['PATH_INFO'])
			(new PostController())->count_action();
		
		/* ajax loading of new posts - refreshing the list of posts on a displayed page */
		else if('/load_posts' == $_SERVER['PATH_INFO'])
			(new PostController())->load_action();
		
		/* after a new comment is submitted, validate data and save a new comment in the database */
		else if('/save_comment' == $_SERVER['PATH_INFO'])
			(new CommentController())->save_action();
		
		/* ajax check if the number of comments changed since the page was displayed to the user */
		else if('/count_comments' == $_SERVER['PATH_INFO'] && isset($_GET['post_id']))
			(new CommentController())->count_action($_GET['post_id']);
		
		/* ajax loading of new comments - refreshing the list of comments on a displayed page */
		else if('/load_comments' == $_SERVER['PATH_INFO'] && isset($_GET['post_id']))
			(new CommentController())->load_action($_GET['post_id']);
		
		else
			self::show_404();
	}
	
	public static function redirect($path='/', $data=null){
		if($path == 'post' && $data)
			header('Location: '.BASE_URL.'/post?id='.$data);
		else
			header('Location: '.BASE_URL.$path);			
		exit();
	}
	
	public static function show_404($msg=''){
		header('HTTP/1.0 404 Not Found');
		View::render('error'.DIRECTORY_SEPARATOR .'404', array('msg'=>$msg));
	}
	
	public static function show_500($msg=''){
		header('HTTP/1.0 500 Internal Server Error');
		View::render('error'.DIRECTORY_SEPARATOR .'500', array('msg'=>$msg));
	}
	
	/* Function to create and display flash messages(in case that the user turns off javascript, this will still display a message)
	 * $_SESSION[$session_name] holds the message and $_SESSION[$session_name.'_class'] holds the style class
	 */
	public static function flash($session_name='', $message='', $class='success fadeout-message'){	
		if(empty($session_name)) return;
		/* No message, create it */
		if(empty($_SESSION[$session_name]) && !empty($message)){
			if(!empty($_SESSION[$session_name.'_class']))
				unset($_SESSION[$session_name.'_class']);
			$_SESSION[$session_name] = $message;
			$_SESSION[$session_name.'_class'] = $class;
		}
		/* Message exists, display it */
		elseif(!empty($_SESSION[$session_name])){
			$class = !empty($_SESSION[$session_name.'_class'])? $_SESSION[$session_name.'_class'] : 'success';
			//echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$session_name].'</div>';
			echo '<script>alert("'.$_SESSION[$session_name].'")</script>';
			unset($_SESSION[$session_name]);
			unset($_SESSION[$session_name.'_class']);
		}
	}
}
<?php
namespace Studios\Controllers;
use \Studios\Router,
	\Studios\View,
	\Studios\Models\CommentModel;
	
class CommentController{
	
	/**
	 * Return number of comments on post identified by ID param.
	 * 
	 * @param integer id of a post
	 */
	public function count_action($id){
		echo (new CommentModel())->getCount($id);
	}
	
	/**
	 * Render out list of comments of a post identified by ID param.
	 * 
	 * @param integer id of a post
	 */
	public function load_action($id){
		$comments = (new CommentModel())->getByPostId($id);
		View::render('partials'.DIRECTORY_SEPARATOR .'comments', array('comments'=>$comments));
	}
	
	/**
	 * Save submitted comment to a database.
	 */
	public function save_action(){

		if(isset($_POST['captcha']) && trim($_POST['captcha']) && $_SESSION['code']==$_POST['captcha'] && isset($_POST['post_id']) && trim($_POST['post_id']) && isset($_POST['email']) && trim($_POST['email']) && isset($_POST['content']) && trim($_POST['content'])){
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", trim($_POST['email'])))
				Router::flash('comment_form_error', 'Email is not in the correct format.', 'error');
			else if((new CommentModel())->is_spam_comment(trim($_POST['post_id']), trim($_POST['email']), trim($_POST['content'])) > 0)
				Router::flash('comment_form_error', 'You have already posted such comment on this post.', 'error');
			else
				(new CommentModel())->save($_POST);
		}
		else
			Router::flash('comment_form_error', 'Please fill in all the fields.', 'error');
		
		Router::redirect('post', trim($_POST['post_id']));
	}
}
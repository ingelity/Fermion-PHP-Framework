<?php
namespace Studios\Controllers;
use \Studios\Router,
	\Studios\View,
	\Studios\Models\PostModel,
	\Studios\Models\CommentModel;
	
class PostController{

	/**
	 * Display the page with a list of all posts.
	 */
	public function list_action(){
		$posts = (new PostModel())->getAll();
		View::render('post'.DIRECTORY_SEPARATOR .'posts_list', array('posts'=>$posts));
	}
	
	/**
	 * Return the number of posts in a database.
	 */
	public function count_action(){
		echo (new PostModel())->getCount();
	}
	
	/**
	 * Return the list of all posts.
	 */
	public function load_action(){
		$posts = (new PostModel())->getAll();
		View::render('partials'.DIRECTORY_SEPARATOR .'posts', array('posts'=>$posts));
	}
	
	/**
	 * Display post identified by ID param.
	 */
	public function show_action($id){
		$post = (new PostModel())->getById($id);
		$comments = (new CommentModel())->getByPostId($id);
		View::render('post'.DIRECTORY_SEPARATOR .'single_post', array('post'=>$post, 'comments'=>$comments));
	}
	
	/**
	 * Validate passed form data and save a post in a database.
	 */
	public function save_action(){
		
		if(isset($_POST['captcha']) && trim($_POST['captcha']) && $_SESSION['code']==$_POST['captcha'] && isset($_POST['title']) && trim($_POST['title']) && isset($_POST['email']) && trim($_POST['email']) && isset($_POST['content']) && trim($_POST['content']))
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", trim($_POST['email'])))
				Router::flash('post_form_error', 'Email is not in the correct format.', 'error');
			else if((new PostModel())->is_unique_hash(md5(trim($_POST['content']))) > 0)
				Router::flash('post_form_error', 'Such post already exists.', 'error');
			else{
				$id = (new PostModel())->save($_POST);
				Router::redirect('post', $id);
			}
		else
			Router::flash('post_form_error', 'Please fill in all the fields.', 'error');
	}
}
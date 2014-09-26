<?php
namespace Fermion;
use \Fermion\Controllers\PostController;

class Router {

	/**
	 * @var PostController
	 */
	protected $postController;

	/**
	 * Router constructor
	 *
	 * @param PostController
	 * @return void
	 */
	public function __construct(PostController $pc) {
		$this->postController = $pc;
	}

	/**
	 * Routing function
	 *
	 * @param array
	 * @return void
	 */
	public function route($request) {
		// for every POST request check csrf and if it was spoofed then return
		if($request['REQUEST_METHOD'] == 'POST' && (empty($request['post']['csrf']) || !$this->checkCSRF($request['post']['csrf']))) 
			return; //App::get('response')->redirect('/');
		
		// match route and fire off corresponding action
		$action = $this->mapRoute($request);
		call_user_func_array([$this, 'dispatchRoute'], $action);
	}
	
	/**
	 * CSRF verification
	 *
	 * @param string
	 * @return boolean
	 */
	public function checkCSRF($csrf=null) {
		return (empty($csrf) || App::get('config')['csrf'] === $csrf) ? true : false;
	}
	
	/**
	 * Mapping route function
	 *
	 * @param array
	 * @return array
	 */
	public function mapRoute($request) {
		
		// ajax check if the number of posts changed since the page was displayed to the user
		if('/post-count' === $request['PATH_INFO']) {
			return ['postController', 'countAction'];
		}
		
		// ajax loading of new posts - refreshing the list of posts on a displayed page
		else if('/post-load' === $request['PATH_INFO']) {
			return ['postController', 'listAction', []];
		}
		
		// list all posts
		else if('/' === $request['REQUEST_URI']) {
			// setting the data for the view and params for the render function
			$data = ['page' => 'news'];
			return ['postController', 'listAction', $data];	
		}
		
		// display form for creating a new post
		else if(strpos($request['PATH_INFO'], '/post-new') !== false) {
			$data = ['page' => 'news'];
			return ['postController', 'createAction', $data];
		}
		
		// publish the post
		else if(strpos($request['PATH_INFO'], '/post-publish/') !== false) {
			// extracting the post's id from PATH_INFO
			$id = str_replace('/', '', substr($request['PATH_INFO'], 14));
			$data = ['id' => $id, 'post' => $request['post']];
			return ['postController', 'publishAction', $data];
		}
		
		// display a form for editing a post
		else if(strpos($request['PATH_INFO'], '/post-edit/') !== false) {
			$slug = str_replace('/', '', substr($request['PATH_INFO'], 11));
			$data = ['page' => 'news', 'slug' => $slug];
			return ['postController', 'editAction', $data];
		}
		
		// search for posts based on provided keystring
		else if(strpos($request['PATH_INFO'], 'post-search') !== false) {
			$data = ['keystring' => $request['post']['keystring']];
			return ['postController', 'searchAction', $data];
		}
		
		// after the form for creating a new post is submitted, validate data and save the new post in the database
		else if('/post-save' === $request['PATH_INFO']) {
			$data = ['post' => $request['post']];
			return ['postController', 'saveAction', $data];
		}
		
		// after the form for updating a post is submitted, validate data and update the post in the database
		else if(strpos($request['PATH_INFO'], '/post-update/') !== false) {
			$id = str_replace('/', '', substr($request['PATH_INFO'], 13));
			// show not found page if the request has an invalid format
			if(empty($id)) return ['postController', '404'];
			$data = ['post' => $request['post'], 'id' => $id];
			return ['postController', 'saveAction', $data];
		}
		
		// show single post
		else if(strpos($request['PATH_INFO'], '/post/') !== false) {
			// extracting the slug from PATH_INFO
			$slug = str_replace('/', '', substr($request['PATH_INFO'], 6));
			$data = ['page' => 'news', 'slug' => $slug];
			return ['postController', 'showAction', $data];
		}
		
		// if no route was matched
		else {
			return ['postController', '404'];
		}
	}
	
	/**
	 * Dispatching to a controller's action
	 *
	 * @param string
	 * @param string
	 * @param array
	 * @return void
	 */
	public function dispatchRoute($controller, $action, $args=[]) {
		
		($action === '404') ? App::get('response')->show_404() : $this->$controller->$action($args);
	}
}
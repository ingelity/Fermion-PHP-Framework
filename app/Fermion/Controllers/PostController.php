<?php
namespace Fermion\Controllers;
use \Fermion\Models\PostModel,
	\Fermion\App;
	
class PostController {

	/**
	 * @var PostModel
	 */
	protected $postModel;
	
	/**
	 * PostController constructor
	 *
	 * @param PostModel
	 * @return void
	 */
	public function __construct(PostModel $pm) {
		$this->postModel = $pm;
	}
	
	/**
	 * Display the page with a list of all posts or just return all posts.
	 *
	 * @param array
	 * @return View
	 */
	public function listAction($args) {
		
		$posts = $this->postModel->getAll();
		$data = ['posts' => $posts];
		
		if(empty($args['page'])) {
			return App::get('response')->render('partials/posts', false, $data);
		}
		
		$data['page'] = $args['page'];
		return App::get('response')->render('post/list', true, $data);
	}
	
	/**
	 * Return all posts that match the search keywords.
	 *
	 * @return array
	 * @return View
	 */
	public function searchAction($args) {
		
		$posts = empty($args['keystring']) ? $this->postModel->getAll() : $this->postModel->search($args['keystring']);
		$data = ['posts' => $posts];
		
		return App::get('response')->render('partials/posts', false, $data);
	}
	
	/**
	 * Return the number of posts in a database.
	 * 
	 * return integer
	 */
	public function countAction() {
		echo $this->postModel->getCount();
	}
	
	/**
	 * Display a form for editing a post identified by slug param.
	 * 
	 * @param array
	 * @return View
	 */
	public function createAction($args) {
		
		$data = ['page' => $args['page']];
		return App::get('response')->render('post/create-edit', true, $data);
	}
	
	/**
	 * Display a form for editing a post identified by slug param.
	 * 
	 * @param array
	 * @return View
	 */
	public function editAction($args) {
		
		if(empty($args['slug'])) 
			return App::get('response')->show_404();
		
		$post = $this->postModel->getBySlug($args['slug']);
		$data = ['page' => $args['page'], 'post' => $post];
		
		return App::get('response')->render('post/create-edit', true, $data);
	}
	
	/**
	 * Display post identified by slug param.
	 * 
	 * @param array
	 * @return View
	 */
	public function showAction($args) {
		
		if(empty($args['slug'])) 
			return App::get('response')->show_404();
		
		$post = $this->postModel->getBySlug($args['slug']);
		$data = ['page' => $args['page'], 'post' => $post];
		
		return App::get('response')->render('post/single', true, $data);
	}
	
	/**
	 * Save a post in a database.
	 * 
	 * @param array
	 * @return View
	 */
	public function saveAction($args) {
		
		$post = $args['post'];
		$id = empty($args['id']) ? 0 : $args['id'];
		
		// validate input data
		$validated = App::get('validator')->validate($post, PostModel::$rules);
		
		if(!$validated->hasPassed) {
			// set the error flash message and redirect back to the page from which the request came
			$msg = ['error', $validated->errorMessage];
			return App::get('response')->redirect('back', $msg, true);
		}
		else {
			$post['slug'] = App::get('helper')->sluggify($post['title']);
			// if save was unsuccessful, set the error flash message and redirect back
			if(!$this->postModel->save($post, $id)) {
				$msg = ['error', 'Failed to save in a database.'];
				return App::get('response')->redirect('back', $msg, true);
			}
			// if save was successful, redirect to the preview page
			return App::get('response')->redirect('/post/'.$post['slug']);
		}
	}
	
	/**
	 * Publish a previously created post.
	 * 
	 * @param array
	 * @return View
	 */
	public function publishAction($args) {
		
		if(empty($args['id'])) return;
		
		// if publishing was unsuccessful, set the error flash message and redirect back
		if(!$this->postModel->publish($args['id'])) {
			$msg = ['error', 'Failed to publish.'];
			return App::get('response')->redirect('back', $msg, true);
		}
		// if publishing was successful, set the success flash message and redirect to the home page
		$msg = ['success', 'Successfully published.'];
		return App::get('response')->redirect('/', $msg);		
	}
}
<?php 
namespace Fermion;

class Request {

	/**
	 * @var array
	 */
	public $data;
	
	/**
	 * Request constructor
	 *
	 * @return void
	 */
	public function __construct() {
		
		$this->data = array(
			'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
			'REQUEST_URI' => $_SERVER['REQUEST_URI'], // "/foo/bar?test=abc" or "/foo/index.php/bar?test=abc"
			'PATH_INFO' => empty($_SERVER['PATH_INFO']) ? '' : $_SERVER['PATH_INFO'], // "/foo"
			'HTTP_REFERER' => empty($_SERVER['HTTP_REFERER']) ? '/' : $_SERVER['HTTP_REFERER'],
			'get' => $_GET,
			'post' => $_POST
		);
	}
}
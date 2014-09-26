<?php 
namespace Fermion;
use \Fermion\Controllers\PostController,
	\Fermion\Models\PostModel;

/* Ensuring that a session exists */
if(!session_id())
	session_start();

// defining global constants
define('APP_PATH', dirname(__DIR__) . '/app/');
define('CONFIG_PATH', APP_PATH . 'config/');
define('VIEWS_PATH', APP_PATH . 'Fermion/Views/');
define('SITE_URL', 'http://fermion.localhost');

// autoloader
spl_autoload_register(function($class_name) {
	try {
		if(file_exists($file = APP_PATH .$class_name.'.php'))
			include($file);
		else
			throw new \Exception('Unable to load '.$file.'.');
	}
	catch(\Exception $e) {
		echo $e->getMessage();
	}
});
	
/* setting up and starting the app */	// NOTE: -> for future use, a special function will be setup to bootstrap these dependencies. perhaps with PHP reflection.
$postModel = new PostModel;
$postController = new PostController($postModel);
(new App(new Router($postController), new Request, new Response, new Validator, new Helper))->run();
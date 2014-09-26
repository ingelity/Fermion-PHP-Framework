<?php 
namespace Fermion;
use \Fermion\Controllers\PostController,
	\Fermion\Models\PostModel;

class App {
	
	/**
	 * @var array
	 */
	protected $container;
	
	/**
	 * @var \Fermion\App 
	 */
	protected static $app;

	/**
	 * Getting object from Application's IoC container
	 *
	 * @param string $name
	 * @return \Fermion\App|null
	 */
	public static function get($name) {
	
		if(isset(static::$app) && static::$app instanceOf App)
			$app = static::$app;
		else {
			$postModel = new PostModel;
			$postController = new PostController($postModel);
			$app = new App(new Router($postController), new Request, new Response, new Validator, new Helper);
			static::$app = $app;
		}
		
		return isset($app->container[$name]) ? $app->container[$name] : null;
	}
	
	/**
	 * Application constructor
	 *
	 * @return void
	 */
	public function __construct(Router $router, Request $request, Response $response, Validator $validator, Helper $helper) {
	
		// IoC container
		$this->container = array(
			'router' => $router,
			'request' => $request,
			'response' => $response,
			'validator' => $validator,
			'helper' => $helper,
			'config' => include CONFIG_PATH . 'app.php'
		);
		
		// saving a reference to an instance of the App class
		static::$app = $this;
	}
	
	/**
	 * Application setup and initiator method
	 *
	 * @return void
	 */
	public function run() {
		// starting the router request matching
		$router = self::get('router');
		$request = self::get('request');
		$router->route($request->data);
	}
}
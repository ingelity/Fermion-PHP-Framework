<?php
namespace Studios;

/* Ensuring that a session exists */
if(!session_id())
	session_start();

/* Defining global constants */
define('CORE_PATH', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('SOURCE_PATH', CORE_PATH.'src'.DIRECTORY_SEPARATOR);
define('CONFIG_PATH', CORE_PATH.'config'.DIRECTORY_SEPARATOR);
define('TEMPLATES_PATH', SOURCE_PATH.'Studios'.DIRECTORY_SEPARATOR .'Templates'.DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://studios.localhost');
define('LANGUAGE', isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'en');

/* Loading detected language content */
switch(LANGUAGE){
	case 'de':
		$GLOBALS['lang_main'] = include CORE_PATH.'languages'.DIRECTORY_SEPARATOR .'de'.DIRECTORY_SEPARATOR .'main.php';
		break;
	case 'kr':
		$GLOBALS['lang_main'] = include CORE_PATH.'languages'.DIRECTORY_SEPARATOR .'kr'.DIRECTORY_SEPARATOR .'main.php';
		break;
	default:
		$GLOBALS['lang_main'] = include CORE_PATH.'languages'.DIRECTORY_SEPARATOR .'en'.DIRECTORY_SEPARATOR .'main.php';
}

/* Simple PSR-0 autoloader */
spl_autoload_register(function($class_name){
    try {
		if(file_exists($file = SOURCE_PATH .$class_name.'.php'))
			include($file);
		else
			throw new \Exception('Unable to load '.$file.'.');
	}
	catch(\Exception $e){
		echo $e->getMessage();
	}
});

/* Initiating our app */
Router::route();
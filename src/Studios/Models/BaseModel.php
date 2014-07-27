<?php 
namespace Studios\Models;
use \Studios;

class BaseModel{
	
	/**
	 * The database connector used by the model.
	 *
	 * @var PDO object
	 */
	protected $pdo;
	
	/**
	 * Instantiate a new BaseModel
	 */
	function __construct(){
		$credentials = include CONFIG_PATH. DIRECTORY_SEPARATOR .'database' . DIRECTORY_SEPARATOR .'db_credentials.php';
		try {
			$this->pdo = new \PDO("mysql:host=".$credentials['host'].";dbname=".$credentials['database'], $credentials['username'], $credentials['password']);
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Destructor for BaseModel
	 */
	function __destruct(){
		$this->pdo = null;
	}
}
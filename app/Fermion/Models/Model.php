<?php 
namespace Fermion\Models;
use \Fermion;

class Model {
	
	/**
	 * DB connector
	 *
	 * @var PDO
	 */
	protected $pdo;
	
	/**
	 * BaseModel constructor
	 *
	 * @return void
	 */
	protected function __construct() {
		
		$credentials = include CONFIG_PATH . 'database/db_credentials.php';
		try {
			$this->pdo = new \PDO("mysql:host=".$credentials['host'].";dbname=".$credentials['database'], $credentials['username'], $credentials['password']);
		}
		catch(\PDOException $e) {
			App::get('response')->show_500($e->getMessage());
		}
	}
	
	/**
	 * BaseModel destructor
	 *
	 * @return void
	 */
	function __destruct() {
		$this->pdo = null;
	}
}
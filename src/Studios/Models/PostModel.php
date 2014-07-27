<?php 
namespace Studios\Models;
use \Studios\Router;

class PostModel extends BaseModel{

	/**
	 * Return the number of posts in database.
	 */
	public function getCount(){
		try{
			$stmCount = $this->pdo->prepare("SELECT COUNT(*) FROM posts");
			$stmCount->execute();
			$count = $stmCount->fetch();
			$stmCount->closeCursor();
			return $count[0];
		}
		catch(\PDOException $e){
			//return false;
		}
	}
	
	/**
	 * Check if a post with the same content already exists in a database.
	 */
	public function is_unique_hash($hash){
		try{
			$stmHash = $this->pdo->prepare("SELECT COUNT(*) FROM posts WHERE content_hash=?");
			$stmHash->execute(array($hash));
			$count = $stmHash->fetch();
			$stmHash->closeCursor();
			return $count[0];
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Save post in a database.
	 */
	public function save($post){
		try{
			$stmSave = $this->pdo->prepare("INSERT INTO posts(title, email, content, content_hash) VALUES (:title, :email, :content, :content_hash)");
			$post_content = preg_replace("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", "<a href='$0'>$0</a>", explode(' ',$post['content']));
			$post_content = implode(" ", $post_content);
			$post['content'] = preg_replace("/href='www./", "href='http://www.", $post_content);
			
			$stmSave->execute(array(
				':title' => trim($post['title']), 
				':email' => trim($post['email']),
				':content' => trim($post['content']),
				':content_hash' => md5(trim($post['content']))
			));
			return $this->pdo->lastInsertId();
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Return a post identified by ID param.
	 */
	public function getById($id){
		try{
			$stmGetById = $this->pdo->prepare("SELECT * FROM posts WHERE id=?");
			$stmGetById->execute(array($id));
			$post = $stmGetById->fetch(\PDO::FETCH_ASSOC);
			$stmGetById->closeCursor();
			return $post;
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Return the list of all posts.
	 */
	public function getAll(){
		try{
			$stmGetAll = $this->pdo->prepare("SELECT * FROM posts");
			$stmGetAll->execute();
			$posts = $stmGetAll->fetchAll(\PDO::FETCH_ASSOC);
			$stmGetAll->closeCursor();
			return $posts;
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
}
<?php 
namespace Studios\Models;
use \Studios\Router;

class CommentModel extends BaseModel{
	
	/**
	 * Return the number of comments for a post identified by ID param.
	 */
	public function getCount($id){
		try{
			$stmCount = $this->pdo->prepare("SELECT COUNT(*) FROM comments WHERE post_id=?");
			$stmCount->execute(array($id));
			$count = $stmCount->fetch();
			$stmCount->closeCursor();
			return $count[0];
		}
		catch(\PDOException $e){
			//return false;
		}
	}
	
	/**
	 * Check if a same comment exists for a post identified by ID param.
	 */
	public function is_spam_comment($id, $email, $content){
		try{
			$stmSpam = $this->pdo->prepare("SELECT COUNT(*) FROM comments WHERE post_id=? AND email=? AND content=?");
			$stmSpam->execute(array($id, $email, $content));
			$count = $stmSpam->fetch();
			$stmSpam->closeCursor();
			return $count[0];
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Save comment in a database.
	 */
	public function save($comment){
		try{
			$stmSave = $this->pdo->prepare("INSERT INTO comments(post_id, email, content) VALUES (:post_id, :email, :content)");
			$comment_content = preg_replace("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", "<a href='$0'>$0</a>", explode(' ',$comment['content']));
			$comment_content = implode(" ", $comment_content);
			$comment['content'] = preg_replace("/href='www./", "href='http://www.", $comment_content);
			
			return $stmSave->execute(array(
				':post_id' => trim($comment['post_id']), 
				':email' => trim($comment['email']),
				':content' => trim($comment['content'])
			));
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
	
	/**
	 * Return all comments for a post identified by ID param.
	 */
	public function getByPostId($id){
		try{
			$stmGetByPostId = $this->pdo->prepare("SELECT * FROM comments WHERE post_id=?");
			$stmGetByPostId->execute(array($id));
			$comments = $stmGetByPostId->fetchAll(\PDO::FETCH_ASSOC);
			$stmGetByPostId->closeCursor();
			return $comments;
		}
		catch(\PDOException $e){
			Router::show_500($e->getMessage());
		}
	}
}
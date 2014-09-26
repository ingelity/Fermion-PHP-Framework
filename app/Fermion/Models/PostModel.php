<?php 
namespace Fermion\Models;

class PostModel extends Model {

	/**
	 * @var array
	 */
	public static $rules = [ // NOTE: -> in the future this will include detailed rules (i.e. type of variable, size/length etc.)
		'title',
		'author',
		'date',
		'content'
	];

	/**
	 * PostModel constructor
	 *
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
	}

	/**
	 * Return the number of posts in the database.
	 *
	 * @return integer
	 */
	public function getCount() {
		try{
			$stm = $this->pdo->prepare("SELECT COUNT(*) FROM news WHERE status='published'");
			$stm->execute();
			$count = $stm->fetch();
			$stm->closeCursor();
			return $count[0];
		}
		catch(\PDOException $e) {
			return -1;
		}
	}
	
	/**
	 * Search based on post's title.
	 *
	 * @param string
	 * @return array
	 */
	public function search($keystring) {
		try {
			$list = explode(' ',$keystring);
			$query = "SELECT * FROM news WHERE status='published' AND (";
			$sqlOption = array();
			// "SELECT * FROM news WHERE status='published' AND (LOWER(title) LIKE 'keyword1' OR LOWER(title) LIKE 'keyword2' OR...) ORDER BY date DESC"
			foreach($list as $key => $val) {
				// escaping characters with slashes (i.e. "it\'s")
				$list[$key] = '%'.addslashes(strtolower($val)).'%';
				$sqlOption[] = "LOWER(title) LIKE ?";
			}
			$query .= " " . join(' OR ', $sqlOption) . ") ORDER BY date DESC;";

			$stm = $this->pdo->prepare($query);
			$stm->execute($list);
			$posts = $stm->fetchAll(\PDO::FETCH_ASSOC);
		
			$stm->closeCursor();
			return $posts;
		}
		catch(\PDOException $e) {
			return ['error'=>'error'];
		}
	}
	
	/**
	 * Save or update a post in the database.
	 *
	 * @param array
	 * @param integer
	 * @return boolean
	 */
	public function save($post, $id) {
		try {
			// parsing links
			$post_content = preg_replace("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", "<a href='$0'>$0</a>", explode(' ', $post['content']));
			$post_content = implode(" ", $post_content);
			$post['content'] = preg_replace("/href='www./", "href='http://www.", $post_content);
			
			$params = array(
				':title' => trim($post['title']), 
				':slug' => trim($post['slug']), 
				':author' => trim($post['author']),
				':date' => trim($post['date']),
				':content' => trim($post['content'])
			);
			
			if(!$id) {
				$stm = $this->pdo->prepare("INSERT INTO news(title, slug, author, date, content, status) VALUES (:title, :slug, :author, :date, :content, 'pending')");
			}
			else {
				$params[':id'] = $id;
				$stm = $this->pdo->prepare("UPDATE news SET title=:title, slug=:slug, author=:author, date=:date, content=:content, status='pending' WHERE id=:id");
			}
			
			$res = $stm->execute($params);
			return $res;
		}
		catch(\PDOException $e) {
			App::get('response')->show_500($e->getMessage());
		}
	}
	
	/**
	 * Change the status of a previously created post to 'published'.
	 *
	 * @param array
	 * @return boolean
	 */
	public function publish($id) {
		try {
			$stm = $this->pdo->prepare("UPDATE news SET status='published' WHERE id=?");
			$res = $stm->execute([$id]);
			return $res;
		}
		catch(\PDOException $e) {
			App::get('response')->show_500($e->getMessage());
		}
	}
	
	/**
	 * Return a post identified by the slug param.
	 *
	 * @param string
	 * @return array
	 */
	public function getBySlug($slug) {
		try {
			$stm = $this->pdo->prepare("SELECT * FROM news WHERE slug=?");
			$stm->execute([$slug]);
			$post = $stm->fetch(\PDO::FETCH_ASSOC);
			$stm->closeCursor();
			return $post;
		}
		catch(\PDOException $e) {
			App::get('response')->show_500($e->getMessage());
		}
	}
	
	/**
	 * Return a list of all posts.
	 * 
	 * @return array
	 */
	public function getAll() {
		try {
			$stm = $this->pdo->prepare("SELECT * FROM news WHERE status='published' ORDER BY date DESC");
			$stm->execute();
			$posts = $stm->fetchAll(\PDO::FETCH_ASSOC);
			$stm->closeCursor();
			return $posts;
		}
		catch(\PDOException $e) {
			App::get('response')->show_500($e->getMessage());
		}
	}
}
<?php
class Article {
	private $articleDir = '../../backend/content/article/';
	private $articleDirInsert = '../content/article/';
	private $article = null;

	function __construct() {}
	function __destruct() {}

	private function getArticleDir() {
		return $this->articleDir;
	}

	private function getArticleDirInsert() {
		return $this->articleDirInsert;
	}

	private function getArticleFullpathById($id) {
		return $this->getArticleDir()."article_$id.json";
	}

	private function getArticleFullpathByIdInsert($id) {
		return $this->getArticleDirInsert()."article_$id.json";
	}

	/** check if an article is loaded and valid
	*	@return		Bool
	*/
	private function isArticleLoaded() {
		if($this->article === null || !is_array($this->article) ) {
			return false;
		} else {
			return true;
		}
	}

	/**	get the loaded article
	*	@return 	FALSE || Array
	*/
	public function getLoadedArticle() {
		if($this->isArticleLoaded()) {
			return $this->article;
		} else {
			return false;
		}
	}

	/** set the article in the class
	*	@return		Bool
	*/
	private function setLoadedArticle($article) {
		if(is_array($article)) {
			$this->article = $article;
			return true;
		} else {
			return false;
		}
	}

	/** Check for the availability of the article
	*	@param		$id		Integer
	*	@retuen		Bool
	*/
	private function existArticleById($id) {
		if( file_exists($this->getArticleFullpathById($id)) ) {
			return true;
		} else {
			return false;
		}
	}

	/** create an empty article in the class
	*	@return 	Bool
	*/
	public function createArticle() {
		$article = array(
			'id' => '',
			'title' => '',
			'subtitle' => '',
			'text' => '',
			'media_type' => '',
			'media_path' => ''
		);
		return $this->setLoadedArticle($article);
	}

	/** load one article
	*	@param		$id		Integer
	*	@return		Array
	*/
	public function loadArticleById($id) {
		$return = array('status' => null, 'msg' => '');
		if( !$this->existArticleById($id) ) {
			$return['status'] = false;
			$return['status'] = 'the requested article does not exists';
		} else {
			$jsonArticle = file_get_contents($this->getArticleFullpathById($id));
			if($jsonArticle === false) {
				$return['status'] = false;
				$return['status'] = 'the requested article does not exists';
			} else {
				var_dump($jsonArticle);
				$article = json_decode($jsonArticle, true);
				if(!is_array($article)) {
					$return['status'] = false;
					$return['status'] = 'the format of the article is not valid';
				} else {
					$this->setLoadedArticle($article);
					$return['status'] = true;
				}
			}
		}
		var_dump($return);
		return $return;
	}

	/** get the id of the loaded article
	*	@return		FALSE || Integer
	*/
	public function getArticleId() {
		if($this->isArticleLoaded()) {
			return $this->article['id'];
		} else {
			return false;
		}
	}

	/** set the title of the loaded article
	*	@return		Bool
	*/
	public function setArticleId($value) {
		if($this->isArticleLoaded()) {
			$this->article['id'] = $value;
			return true;
		} else {
			return false;
		}
	}

	/** get the title of the loaded article
	*	@return		FALSE || String
	*/
	public function getArticleTitle() {
		if($this->isArticleLoaded()) {
			return $this->article['title'];
		} else {
			return false;
		}
	}

	/** set the title of the loaded article
	*	@return		Bool
	*/
	public function setArticleTitle($value) {
		if($this->isArticleLoaded()) {
			$this->article['title'] = $value;
			return true;
		} else {
			return false;
		}
	}

	/** get the subtitle of the loaded article
	*	@return		FALSE || String
	*/
	public function getArticleSubtitle() {
		if($this->isArticleLoaded()) {
			return $this->article['subtitle'];
		} else {
			return false;
		}
	}

	/** set the subtitle of the loaded article
	*	@return		Bool
	*/
	public function setArticleSubtitle($value) {
		if($this->isArticleLoaded()) {
			$this->article['subtitle'] = $value;
			return true;
		} else {
			return false;
		}
	}

	/** get the text of the loaded article
	*	@return		FALSE || String
	*/
	public function getArticleText() {
		if($this->isArticleLoaded()) {
			return $this->article['text'];
		} else {
			return false;
		}
	}

	/** set the text of the loaded article
	*	@return		Bool
	*/
	public function setArticleText($value) {
		if($this->isArticleLoaded()) {
			$this->article['text'] = $value;
			return true;
		} else {
			return false;
		}
	}

	/** get the media type of the loaded article
	*	@return		FALSE || String
	*/
	public function getArticleMediaType() {
		if($this->isArticleLoaded()) {
			return $this->article['media_type'];
		} else {
			return false;
		}
	}

	/** set the media type of the loaded article
	*	@return		Bool
	*/
	public function setArticleMediaType($value) {
		if($this->isArticleLoaded()) {
			if($value == 'img' || $value == 'video') {
				$this->article['media_type'] = $value;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/** get the media path of the loaded article
	*	@return		FALSE || String
	*/
	public function getArticleMediaPath() {
		if($this->isArticleLoaded()) {
			return $this->article['media_path'];
		} else {
			return false;
		}
	}

	/** set the media path of the loaded article
	*	@return		Bool
	*/
	public function setArticleMediaPath($value) {
		if($this->isArticleLoaded()) {
			$this->article['media_path'] = $value;
			return true;
		} else {
			return false;
		}
	}

	/** write the data of the loaded article in a json file
	*	@return		Bool
	*/
	public function writeLoadedArticle() {
		return file_put_contents($this->getArticleFullpathById( $this->getArticleId() ), json_encode($this->getLoadedArticle()));
	}
}
?>

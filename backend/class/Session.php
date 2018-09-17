<?php
class Session {
	private $fullPathSessionIdFile = '../config/session_id.txt';
	private $fullPathSessionIdFileIndex = 'backend/config/session_id.txt';
	private $fullPathSessionIdFileFrontend = '../../backend/config/session_id.txt';

	function __construct() {
		session_start();
		$this->setEmptyCookie();
	}

	function __destruct() { }

	public function getPathSessionFile() {
		return $this->fullPathSessionIdFile;
	}

	public function getPathSessionFileIndex() {
		return $this->fullPathSessionIdFileIndex;
	}

	public function getPathSessionFileFrontend() {
		return $this->fullPathSessionIdFileFrontend;
	}

	/** create empty cookie */
	private function setEmptyCookie() {
		if(ini_get("session_use_cookies")) {		// if "session_use_cookies" is set in php.ini
			$params = session_get_cookie_params();	// get contents of the cookie
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
	}

	/**	generate a new session id 
	*	@return		Bool
	*/
	public function generateNewSessionId() {
		return session_regenerate_id(true);
	}

	/**	get the current session id
	*	@return		String
	*/
	public function getSessionId() {
		return session_id();
	}

	/**	write session id in a text file
	*	@param		$option		String		// who call the function? [index,frontend,normal]
	*	@return		Bool
	*/
	public function saveNewSessionId($option = 'normal') {
		if($option == 'normal') {
			return file_put_contents($this->getPathSessionFile(), $this->getSessionId());
		} elseif($option == 'index') {
			return file_put_contents($this->getPathSessionFileIindex(), $this->getSessionId());
		} elseif($option == 'frontend') {
			return file_put_contents($this->getPathSessionFileFrontend(), $this->getSessionId());
		}
	}

	/**	clear text file for session
	*	@param		$option		String		// who call the function? [index,frontend,normal]
	*	@return		Bool
	*/
	public function clearSessionFile($option = 'normal') {
		if($option == 'normal') {
			return file_put_contents($this->getPathSessionFile(), '');
		} elseif($option == 'index') {
			return file_put_contents($this->getPathSessionFileIndex(), '');
		} elseif($option == 'frontend') {
			return file_put_contents($this->getPathSessionFileFrontend(), '');
		}
	}

	/**	get saved session from text file
	*	@param		$option		String		// who call the function? [index,frontend,normal]
	*	@return		Bool
	*/
	public function getSavedSessionId($option = 'normal') {
		if($option == 'normal') {
			return file_get_contents($this->getPathSessionFile());
		} elseif($option == 'index') {
			return file_get_contents($this->getPathSessionFileIndex());
		} elseif($option == 'frontend') {
			return file_get_contents($this->getPathSessionFileFrontend());
		}
	}
	
	/** set username in session
	*	@param		$user		String
	*	@return		Bool
	*/
	public function setSessionUser($user) {
		if( $this->getSessionId() != '') {
			$_SESSION['user'] = $user;
			return true;
		} else {
			return false;
		}
	}

	/**	delete all data in the current session */
	private function emptySession() {
		$_SESSION = array();
	}

	/** delete the session 
	*	@param		$home		Boolean		// index call => true
	*/
	public function destroySession($home = false) {
		$this->generateNewSessionId();
		$this->emptySession();
		$this->setEmptyCookie();
		$this->clearSessionFile($home);
		session_destroy();
	}

	/**	is user logged in?
	*	@param		$home		Boolean		// index call => true
	*	@return		Bool
	*/
	public function isLoggedIn($home = false) {
		if( (isset($_SESSION['user'])) && ($_SESSION['user']=='admin') ) {
			$sessionId = session_id();
			if( $this->getSavedSessionId($home) == $sessionId ) {
				return true;
			} else {
				$this->destroySession($home);
				return false;
			}
		} else {
			$this->destroySession($home);
			return false;
		}
	}

}
?>

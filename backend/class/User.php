<?php
class User {
	private $userData;

	function __construct() {
		$this->userData = array('admin' => $this->getPasswordHashByPassword('test123') );
	}

	function __destruct() {}

	/**	get the user data
	*	@return		Array
	*/
	public function getUserData() {
		return $this->userData;
	}

	/** create a hash from a password
	*	@param      $password       String
	*	@return     String
	*/
	public function getPasswordHashByPassword($password) {
		return password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
	}

	/** exist the user?
	*	@param		$user		String
	*	@return		Bool
	*/
	private function existUser($user) {
		if( array_key_exists($user, $this->getUserData()) ) {
			return true;
		} else {
			return false;
		}
	}

	/** Compares the two password-hashs
	*	@param		$password		String
	*	@param		$hash			String
	*	@return		Bool
	*/
	private function isPasswordVerify($password, $hash) {
		if( password_verify($password, $hash) ) {
			return true;
		} else {
			return false;
		}
	}

	/** get the password-hash of the user
	*	@param		$user		String
	*	@return		String
	*/
	private function getPasswordHashByUser($user) {
		error_log("user: $user => password-hash: ".$this->getUserData()[$user]);
		return $this->getUserData()[$user];
	}

	/** check if the authentication is possible
	*	@param		$email			String
	*	@param		$password		String
	*	@return		Bool
	*/
	public function isLoginAuthenticated($user, $password) {
		if( $this->existUser($user) === false) {
			error_log("[User] Unknown user");
			return false;
		} else {
			if( $this->isPasswordVerify($password, $this->getPasswordHashByUser($user)) ) {
				return true;
			} else {
				return false;
			}
		}
	}
}

?>

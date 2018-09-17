<?php
require_once '../class/Session.php';
require_once '../class/User.php';

if( isset($_POST['login_submit']) ) {
	$username = htmlspecialchars($_POST['login_username']);
	$password = htmlspecialchars($_POST['login_password']);

	$U = new User();
	if( !$U->isLoginAuthenticated($username, $password) ) {
		error_log('[user] access denied');
	} else {
		$S = new Session();
		if( $S->generateNewSessionId() === false ) {
			error_log('[session] Error while generating a new session id.');
		} else {
			if( $S->saveNewSessionId() === false ) {
				error_log('[session] Error while saving the session id.');
			} else {
				if( !$S->setSessionUser($username) ) {
					error_log("[session] Error while set the username in session.");
				} else {
					header('Location: index.php');
				}
			}
		}
	}
}
header('Location: ../../index.php');
?>

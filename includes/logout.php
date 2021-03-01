<?php
	/*
	 * The session-destroy code from php was used from the code from PHP website "session-destroy" example
	 * available at: https://www.php.net/manual/en/function.session-destroy.php (accessed 26 Feb 2021)
	 * The "session-destroy" example is (c) PHP Group, and is free for reference and to use
	 */

	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!
	session_start();

	// Unset all of the session variables.
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// Finally, destroy the session.
	session_destroy();

	// Redirect to the homepage after session is destroyed
	header("Location: ../index.php");
?>
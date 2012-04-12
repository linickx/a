<?php
	/**
		
		Generic Functions Library - by NB :)

	**/

	function authuser() {

		// Start by booting out people with without cookies.

		if (!isset($_COOKIE['rxalert']['uid'])) { 
			header("Location: $www/twitter.php");
			exit;
		}

		if (!isset($_COOKIE['rxalert']['at'])) { 
			header("Location: $www/twitter.php");
			exit;
		}
	
		if (!isset($_COOKIE['rxalert']['auth'])) { 
			header("Location: $www/twitter.php");
			exit;
		}

		// try to curb any buffer overflows.
		$uid = substr($_COOKIE['rxalert']['uid'], 0, 256);
		$access_token = substr($_COOKIE['rxalert']['at'], 0, 256);
		$uauth = substr($_COOKIE['rxalert']['auth'], 0, 256);

		// generate an authentication string
		$auth = "nb_" . $uid . SALT . $access_token;
		$auth = sha1($auth);

		// does the user submitted auth string match ours?
		if ($uauth === $auth) {

			return true; // life is good!
		
		} else {
			
			// cookies have been tampered with, delete & start again.
			setcookie("rxalert[uid]", "", time() - 3600);
			setcookie("rxalert[at]", "", time() - 3600);
			setcookie("rxalert[auth]", "", time() - 3600);
			header("Location: $www");
			exit;
			
		}

	}

?>
<?php
	/* Session destroy/unset functionality used from Example #1 in PHP.net
	   Authors: PHP.net contributors
	   URL: https://www.php.net/manual/en/function.session-destroy.php
	   Date accessed: March 7 2022

       This code was retrieved from Raghav Sampangi Lecture on Cookies and Sessions
       Week 7 
       URL: https://dal.brightspace.com/d2l/le/content/201526/viewContent/2923378/View
       Date accessed: March 7 2022

	*/

	//start the session.
	session_start();



	// Unset all session variables
	$_SESSION = array();

	// destroy session and delete cookies
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	session_destroy();

    //and redirect!
	header("Location: ../index.php");

   
?>
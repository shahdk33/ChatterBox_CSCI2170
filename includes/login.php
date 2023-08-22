<?php

	require "header.php";
?>

<link href="../css/main.css" rel="stylesheet">


<?php

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		session_start();

		//retrieve email and pass from input and sanitize

		/* Sanitization of string in mysqli
		 Retrieved from: Zybooks Chapter 5.3
		 URL: https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/5/section/3?content_resource_id=55665584 
		 Date accessed: March 7 2022
		*/

		$email = $mysqli -> real_escape_string($_POST["i-email"]);
		$password = $mysqli -> real_escape_string($_POST["i-password"]);

		//sanitization of email 

		/* Email string validation
		Retrieved from: W3Schools
		URL: https://www.w3schools.com/php/php_filter.asp
		Date accessed: March 7 2022
		*/
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		

		//retrieve the table information for the login to be successful 
		$sql = "SELECT * FROM cb_login"; 

		$result = $mysqli->query($sql);
		

		if (!$result) {
		   die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
		}
		
		$id = 0;

		// Loop through all the rows returned by the query
		while ($row = $result->fetch_row()) {

	
			//check if email and password are correct in db 
			if($row[1] === $email && $row[2]===$password){

				//if login is successful, retrieved the id number
				$id = $row[0];
					
				//where the id is the logged in user, get their information
				$sql = "SELECT * FROM cb_users WHERE cb_user_id = $id ";
				$result = $mysqli->query($sql);

				if (!$result) {
					die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
				}
				
				//retrieving THE REQUIRED variables from thre query 
					$row = $result->fetch_row();
					$userid = $row[0];
					$fname = $row[1];
					$lname = $row[2];
                    $role = $row[4];
                    

		
				//Setting the session variables
                $_SESSION["id"] = $userid;

				$_SESSION["email"] = $email;

				$_SESSION["fname"] = $fname;

				$_SESSION["lname"] = $lname;

                $_SESSION["role"] = $role;


				//retrieving content information
				$sql = "SELECT cb_user_firstname, cb_post_content FROM cb_users, cb_posts WHERE cb_post_author_id = cb_user_id";
				$result = $mysqli->query($sql);
				
				if (!$result) {
					die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
				}


                
                $_SESSION["posts"] = $result;

				//redirect to index.php
				header("Location: ../index.php");
				
			}
			 
		}
		
}


?>

<body>
	<main>
		<h2>Login</h2>
			<form method="post">

    			<label for="input">Email</label>
				<input type="email" name="i-email">

				<label for="input">Password</label>
				<input type="password" name="i-password">

				<button type="submit" id="button">Submit</button>

			</form>

<?php
require_once "footer.php"; ?>
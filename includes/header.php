<?php

//STARRING session
    session_start();

	require_once "db.php";
//session variables to use throughout the pages
$email = $_SESSION["email"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];
$role = $_SESSION["role"];
$userid = $_SESSION["id"];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1, initial-scale=1.0">
	<title>A3</title>

	<!-- Authors: Bootstrap developers
		CSS cdn
		Date accesse: March 5 2022
		URL: https://getbootstrap.com/docs/4.4/getting-started/introduction/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<?php
	//linking the css stylehseet for all the pages properly 
	if(basename($_SERVER['PHP_SELF']) =="index.php" || basename($_SERVER['PHP_SELF'])=="profile.php"  ){
?>
	<link rel="stylesheet" href="css/main.css">

	<?php
	}
	else{
		?>
		<link rel="stylesheet" href="../css/main.css">
<?php
	}
?>

    
    
</head>
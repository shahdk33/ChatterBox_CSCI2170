<?php

//starting the db connection and making the object
    $db = new mysqli("localhost", "root", "root", "2170-w2");
    if($db->connect_error){
        die("notconnected! ". $db->connect_error);
    }

    $mysqli = new mysqli("localhost", "root", "root", "2170-w2"); 
	if ($mysqli->connect_errno) {
	    die("Failed to connect to MySQL: ($mysqli->connect_errno) 
	    $mysqli->connect_error");
	}

?>
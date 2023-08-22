<?php
require_once "includes/header.php";
// Include the necessary configuration and database connection code here (e.g., $mysqli, session_start(), etc.)

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the input text from the form submission
    $post_content = $_POST["post_content"];

    // Perform any necessary data validation on $post_content if required.

    // Insert the post into the database
    $sql = "INSERT INTO cb_posts (cb_post_author_id, cb_post_content, cb_post_likes, cb_post_report) 
            VALUES ($userid, '$post_content', 0, 0)";

    $result = $mysqli->query($sql);

    if (!$result) {
        die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
    }

    // Redirect back to the index.php page to show the new post.
    header("Location: index.php");
    exit(); // Important to add this exit() after the header to prevent further execution of the script.
}

?>

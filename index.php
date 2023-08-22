<?php
    // Starter file for A3 in CSCI 2170
    require_once "includes/header.php";
?>

<body>

<main class="pg-main-content">


	<?php
		if(!isset($_SESSION["email"])){
			header("Location: includes/login.php");
			die;
		}
        
		
		//otherwise, set the session variables based off of the login session in login.php
        $email = $_SESSION["email"];
		$fname = $_SESSION["fname"];
		$lname = $_SESSION["lname"];
        $role = $_SESSION["role"];
        $userid = $_SESSION["id"];



        ?>

        <!--Sticky navbar from bootstrap
        URL: https://bootstrap-cheatsheet.themeselection.com/#navbar-sticky-top 
        Date accessed: March 7 2022-->
    <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container-fluid">
        
        <img src="img/logo.jpg" alt="">

        <!--feed should go to index.php for ex if they are in the profile webpage FIX THAT-->
        <a class="navbar-brand" href="#">Feed</a>
    
        <!--bootstrap-->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
             <?php echo $fname . " " . $lname ; ?>
            </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>

<?php



//if admin, then show dashboard
if($role==0){

    ?>
    <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
<?php
}
?>

            <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>


        </ul>
        </div>

        </div>
    </nav>

    <h2>New Post</h2>
    <form action="process_post.php" method="POST">
    <input type="text" name="post_content" placeholder="What's on your mind"></input>
    <button type="submit">Submit</button>
</form>



<?php
        

			//set the content session variables as well (based off of fetching them in login.php)
			$result = $_SESSION["posts"];



			echo "<br> <h2>" . "News Feed" . "</h2>";

            //sql statement to show posts and user names 
            $sql = "SELECT * FROM cb_users, cb_posts WHERE cb_post_author_id = cb_user_id ORDER BY cb_post_id asc";
            $result = $mysqli->query($sql);
            
            if (!$result) {
                die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
            }

            

            //looping through to print the username, post, and like button
            $i =3;
            while($row = $result->fetch_assoc()){
                if("$row[cb_post_report]"< 1){
                echo "<b><p>$row[cb_user_firstname]" . " $row[cb_user_lastname]</b>" . " <br> $row[cb_post_content]" . "<br>";


                //like button LINK
                echo "<br><a href='?link={$i}'>Like</a>" . " ". "$row[cb_post_likes]" . " like this post</p>" . 
                "<p><a href='?report={$i}'>Report</a></p><br>";
                
                }

                else{
                    echo "<b>This post has been reported for community guideline violations</b><br>";
                }
                    
            
                $i++;

            }


//if link is pressed, the query will have the number that the post is in the db

$link = $_GET['link'];
if($link>2){

//sql query to change likes in db based on if $link = cb_post_id
$sql = "UPDATE cb_posts SET cb_post_likes = cb_post_likes + 1 WHERE cb_post_id = $link";
            $result = $mysqli->query($sql);
            
    if (!$result) {
        die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
    }

    //go back to index to show updated likes!!!
    header("Location: index.php");

}


$report = $_GET['report'];

//if we press report
if($report>2){

//update the report table to have 1 
$sql = "UPDATE cb_posts SET cb_post_report = 1 WHERE cb_post_id = $report";
$result = $mysqli->query($sql);

//reporting a post implementation:

$sql = "SELECT cb_user_id FROM cb_users WHERE cb_user_firstname = '{$fname}'";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
}

$row = $result->fetch_row();
$userid = $row[0];


$sql = "INSERT INTO cb_reported_posts VALUES($report,$userid,'reported')";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
}



// Now go back to index to show updated reported post
header("Location: index.php");

}




    
require_once "includes/footer.php";






?>


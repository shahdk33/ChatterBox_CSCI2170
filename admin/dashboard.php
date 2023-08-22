<?php
    require_once "../includes/header.php";

    //if not an admin redirect 
    if($role!=0){
        header("location:../index.php");}


        date_default_timezone_set('America/Halifax');
        // getting current date and time 
        $date = date('Y/m/d h:i');
    
        //set cookie when they access admin dashboard
        setcookie("time", $date);


        if(isset($_COOKIE['time'])){
            echo "You last accessed this admin dashboard at: " . $_COOKIE['time'];
        }
        
        ?>

      
      <!-- Bootstrap navbar
            Authors: Boostrap developers
            Date accessed: March 7 2022
            https://bootstrap-cheatsheet.themeselection.com/#navbar-sticky-top -->
        <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container-fluid">
        
        <img src="../img/logo.jpg" alt="logo of chatterbox text in a speech bubble">

        <a class="navbar-brand" href="../index.php">Feed</a>
    
        <!--Authors: Bootstrap developers
            Date accesse: March 7 2022
            URL: https://getbootstrap.com/docs/4.0/components/dropdowns/
        -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
             <?php echo $fname . " " . $lname ; ?>
            </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="../profile.php">Profile</a></li>

<?php

//if it is an admin, update the navigation to show admin dashboard
if($role==0){

    ?>
    <li><a class="dropdown-item" href="#">Dashboard</a></li>
<?php
}
?>

            <li><a class="dropdown-item" href="../includes/logout.php">Logout</a></li>


        </ul>
        </div>

        </div>
    </nav>


<div id="admin">
    <section>
    <h2>List of Users</h2>


    <?php

    //sql statement to get information from users
$sql = "SELECT * FROM cb_users";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
}

while($row=$result->fetch_row()){
    echo $row[1] . " " . $row[2] . " <a href='#'>Suspend</a><br>";
}


    ?>

    </section>

    <section>
        <h2>Reported Posts</h2>

        <?php

        //sql statement for reported posts and who reported them
$sql = "SELECT * FROM cb_posts, cb_reported_posts, cb_users WHERE cb_reported_post_id = cb_post_id AND cb_post_author_id = cb_user_id";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
}

while($row=$result->fetch_assoc()){
    echo "$row[cb_post_content]" . "<br>Reported by: " . "$row[cb_user_firstname] <a href=''>Delete</a> <a href=''>Clear</a> <br><br>  ";
}

    ?>

    </section>




</div>



<?php



require_once "../includes/footer.php";
?>
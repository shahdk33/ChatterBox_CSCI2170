<?php

require_once "includes/header.php";



?>

        <!--navbar from bootstrap
        https://bootstrap-cheatsheet.themeselection.com/#navbar-sticky-top -->
        <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container-fluid">
        
        <img src="img/logo.jpg" alt="">

        <!--feed should go to index.php for ex if they are in the profile webpage FIX THAT-->
        <a class="navbar-brand" href="index.php">Feed</a>
    
        <!--bootstrap-->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
             <?php echo $fname . " " . $lname ; ?>
            </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>

<?php

//include info about the logged in user
//include their username, and email and password not shown

//SQL STATEMENT FROM cb_users table to retrieve that ifno
//did not have enough time to implement..



//if admin, show the dashboard in dropdown menue
if($role==0){

    ?>
    <li><a class="dropdown-item" href="admin/dashboard.php">Dashbaord</a></li>
<?php

}
?>

            <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>


        </ul>
        </div>

        </div>
    </nav>




<img src="img/user-profile.jpg">





<?php

    require_once "includes/footer.php"
?>
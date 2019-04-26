<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
        <title><?="$appname $userstr"?></title>
        
        <script src="js-ext/jquery-1.11.3.js"></script>
        <link rel='stylesheet' href='css/global.css' type='text/css'>
    </head>
    <body>
        <center>
            <canvas id='logo' width='624' height='96'>$appname</canvas>
        <div class='appname'><?="$appname $userstr"?></div> 
        <script src='js/javascript.js'></script>
<?php 
    if (isset($_SESSION['user'])) {
        echo "<br><ul class='menu'>".
                  "<li><a href='index.php'>Home</a></li>".
                  "<li><a href='members.php'>Members</a></li>".
                  "<li><a href='messages.php'>Messages</a></li>".
                  "<li><a href='profile.php'>Edit Profile</a></li>".
                  "<li><a href='logout.php'>Log out</a></li></ul><br>";
    } else {
        echo "<br><ul class='menu'>".
                    "<li><a href='index.php'>Home</a></li>".
                    "<li><a href='signup.php'>Sign up</a></li>".
                    "<li><a href='login.php'>Log in</a></li></ul><br>";

    }

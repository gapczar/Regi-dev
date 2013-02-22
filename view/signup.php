<?php

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    }
} catch(Exception $e) {
     // log exception
    $log = date('M d, Y H:i:s') . '    ' . $ex->getMessage() . "\n";
    file_put_contents('../app/logs/ExceptionLog.txt', $log, FILE_APPEND);
    
    // render error page
    header("HTTP/1.1 500 Internal Server Error");
    include "../view/error500.php";
}

?>


<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">

        <title>GAPLabs WebCamp : Registration App</title>
        <link rel="stylesheet" href="css/screen.css">

        <!-- Google WebFonts -->
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    </head>
    <body class="magic-container">
        <header>
            <nav>
                <a class="home" href="/">Home</a>
                <a class="signup" href="signup.php">Signup</a>
            </nav>
            <h1><span>GAPLabs</span>WebCamp Registration</h1>
            <h2>Welcome to WebCamp</h2>
        </header>
        <div class="main"  role="main">
            <form class="form" action="" method="POST" enctype="multipart/form-data">
                <ul>
                    <li class="username">
                        <label for="user_display_name">Display Name</label>
                        <input id="user_display_name" name="user[display_name]" type="text" class="text">
                    </li>
                    <li class="name">
                        <label for="user_real_name">Real Name</label>
                        <input id="user_real_name" name="user[real_name]" class="text" type="text">
                    </li>
                    <li class="location">
                        <label for="user_location">Location</label>
                        <input id="user_location" name="user[location]" class="text"  type="text">
                    </li>
                    <li class="email">
                        <label for="user_email">Email</label>
                        <input id="user_email" name="user[email]" class="text" type="text">
                    </li>
                    <li class="dob">
                        <label for="user_date_of_birth">Date of Birth</label>
                        <input id="user_date_of_birth" name="user[user_date_of_birth]" class="text" type="text">
                    </li>
                    <li class="desc">
                        <label for="user_bio">Bio</label>
                        <textarea id="user_bio" name="user[bio]" cols="30" rows="10"></textarea>
                    </li>
                    <li class="">
                        <label for="user_photo">Photo</label>
                        <input id="user_photo" name="user[photo]" type="file">
                    </li>
                </ul>
                <input type="submit" class="submit" value="Signup">
            </form>
        </div>
    </body>
</html>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">

        <title>Home | Regi</title>
        <link rel="stylesheet" href="css/screen.css">

        <!-- Google WebFonts -->
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    </head>
    <body class="magic-container">
        <header>
            <nav>
                <a class="home" href="">Home</a>
                <a class="signup" href="">Signup</a>
            </nav>
            <h1><span>GAPLabs</span>WebCamp Registration</h1>
            <h2>{ Welcome to WebCamp login or signup above. }</h2>
        </header>
        <div class="main"  role="main">
            <br/>
            <form action="" method="GET">
                <input type="text" name="searchq" placeholder="User name">
                <input type="submit" value="Search">
            </form>
            <br/>
            <ul class="user-list">
                <?php foreach ($users as $user) :?>
                <li>
                    <div class="user-photo">
                        <img width="150" height="150" src="<?php echo $user['photo'];?>" alt="No Photo">
                    </div>
                    <div class="user-details">
                        <p class="name">
                            <?php echo $user['real_name']; ?>
                            <em><?php echo $user['display_name']; ?></em>
                        </p>
                        <p class="email"><strong>Email: </strong><?php echo $user['email']; ?></p>
                        <p class="location"><strong>Location: </strong><?php echo $user['location']; ?></p>
                        <p class="birhtdate"><strong>Age: </strong><?php echo $dts->computeAge(new DateTime($user['date_of_birth'])); ?></p>
                        <p class="bio">
                            <strong>Bio:</strong>
                            <?php echo $user['bio']; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </body>
</html>
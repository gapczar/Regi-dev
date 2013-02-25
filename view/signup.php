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
                        <label for="user_display_name">Display Name <span style="color:red;">*</span></label>
                        <input id="user_display_name" name="user[display_name]" type="text" class="text" value="<?php echo $user['display_name'];?>"><br />
                        <?php if(isset($errors['display_name'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['display_name']; ?></span><?php endif;?>
                    </li>
                    <li class="name">
                        <label for="user_real_name">Real Name</label>
                        <input id="user_real_name" name="user[real_name]" class="text" type="text" value="<?php echo $user['real_name'];?>"><br />
                        <?php if(isset($errors['real_name'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['real_name']; ?></span><?php endif;?>
                    </li>
                    <li class="location">
                        <label for="user_location">Location</label>
                        <input id="user_location" name="user[location]" class="text"  type="text" value="<?php echo $user['location'];?>"><br />
                        <?php if(isset($errors['location'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['location']; ?></span><?php endif;?>
                    </li>
                    <li class="email">
                        <label for="user_email">Email <span style="color:red;">*</span></label>
                        <input id="user_email" name="user[email]" class="text" type="text" value="<?php echo $user['email'];?>"><br />
                        <?php if(isset($errors['email'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['email']; ?></span><?php endif;?>
                    </li>
                    <li class="dob">
                        <label for="date_of_birth">Date of Birth</label>
                        <input id="date_of_birth" name="user[date_of_birth]" class="text" type="text" placeholder="YYYY-MM-DD" value="<?php echo $user['date_of_birth'];?>"><br />
                        <?php if(isset($errors['date_of_birth'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['date_of_birth']; ?></span><?php endif;?>
                    </li>
                    <li class="desc">
                        <label for="user_bio">Bio</label>
                        <textarea id="user_bio" name="user[bio]" cols="30" rows="10"><?php echo $user['bio'];?></textarea><br />
                        <?php if(isset($errors['bio'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['bio']; ?></span><?php endif;?>
                    </li>
                    <li class="">
                        <label for="user_photo">Photo</label>
                        <input id="user_photo" name="user[photo]" type="file"><br />
                        <?php if(isset($errors['photo'])): ?><span style="color:red;font-size:10px;"><?php echo $errors['photo']; ?></span><?php endif;?>
                    </li>
                </ul>
                <input type="submit" class="submit" value="Signup">
            </form>
        </div>
    </body>
</html>

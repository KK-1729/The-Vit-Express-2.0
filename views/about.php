<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/about.css">
    <script src="https://unpkg.com/scrollreveal"></script>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg row">
        <a class="navbar-brand col-lg-6" href="#">
            <img src="../public/images/nav_logo.png" height="28" alt="Couldn't load picture" class="logo-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-lg-6" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link home-link" href="landing.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <?php
                        if( empty($_SESSION['user']) )
                            echo '<a class="nav-link" href="login.php">Login</a>';
                        else
                            echo '<a class="nav-link" href="../logout.php">Logout</a>';
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                        if( empty($_SESSION['user']) )
                            echo '<a class="nav-link btn" href="signup.php">Sign Up</a>';
                        else if($_SESSION['username'] == 'admin')
                            echo '<a class="nav-link btn" href="post_check.php">Check Posts</a>';
                        else
                            echo '<a class="nav-link btn" href="profile.php">Profile</a>';
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="about container">
        <h1 class="about-head">About</h1>
        <p class="about-text">
            There is so much news related to college circulating everyday through different social media
            platforms from unverified sources. We are unable to predict whether it is actually true or not and
            subsequently turn to other people be it friends, proctors, faculty members etc. for checking the
            authenticity of the news. If the other people are also unaware of it, then they also do the same
            and turn to other people for verification and this process goes on and on if the news is just a
            rumour. This creates chaos among the students and staff members and ultimately the college
            administration has to intervene and clear the air with an official mail. So, a rumour which was
            spread by a bunch of notorious students can lead to so much chaos and inconvenience among
            other students and the college fraternity.
            <br><br>
            The VIT Express aims to keep the VIT community updated about day to day happenings in the
            college.
        </p>
    </div>

    <script src="../public/javascript/about.js" type="text/javascript"></script>
</body>
</html>
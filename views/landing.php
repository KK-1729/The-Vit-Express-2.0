<?php
    session_start();
    require_once "../config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/827465cdd7.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="../public/css/landing.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg row">
        
        <a class="navbar-brand col-lg-6" href="#">
            <img src="../public/images/nav_logo.png" height="28" alt="Couldn't load picture" class="logo-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-lg-6" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link home-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
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
    <div id="main">
        <div class="jumbotron">
            <div class="jumb-content">
                <h1 class="display-4">Want to know what's <br>happening?</h1>
                <p class="lead">
                    <a class="btn btn-lg" href="news.php" role="button">Let's Go <i class="fas fa-arrow-right"></i></a>
                </p>
            </div>
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/4acb4930711751.57fbf7ea19c6d.jpg" alt="Couldn't load picture" class="newspic" style="margin-left:-200px;margin-top:20px;">
        </div>
        <marquee behavior="alternate" direction="left" class="tag">
            The one stop for all <span class="inner-marquee">VIT News</span> 
        </marquee>
    </div>
    <div id="news" style="margin-left:-50px;">
        <div class="rumour">
            <h2 class="rumour-heading">You definitely don't wanna <br>believe this!</h2>
            <?php
                $i = 1;
                $sql = "select * from posts where approval=1 and class='Rumour' order by likes DESC";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if($num == 0) {
                    echo '<h4 align="center" class="card card-title">No Content have been Approved Yet</h4>';
                }

                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $class = $row['class'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $image = $row['image'];
                    if($i <= 4) {
            ?>
                        <div class="card rumour_left">
                            <h4 class="card-title"><?php echo $title?></h4>
                            <p class="card-text">
                                    <?php echo substr($content,0,66); ?>
                                <a href="post.php?id=<?php echo $row['post_id']; ?>" class="post-link">...Read More</a>
                            </p>
                        </div>
            <?php
                        $i++;
                    }
                }
            ?>    
        </div>
        <div class="inner-circle"></div>
        <div class="outer-circle"></div>
        <div class="headlines" style="margin-left:-20px;margin-top:30px;">
            <h2 class="headlines-heading" style="margin-top:-30px;">Trending in VIT</h2><br><br>
            <?php
                $i = 1;
                $sql = "select * from posts where approval = 1 and class = 'Headline' order by likes DESC";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 0) {
                    echo '<h4 align="center" class="card card-title">No Content have been Approved Yet</h4>';
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $class = $row['class'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $image = $row['image'];
                    if($i<=4) {
            ?>
                        <div class="card top-card">
                            <h4 class="card-title"><?php echo $title?></h4>
                            <p class="card-text">
                                    <?php echo substr($content,0,66); ?>
                                <a href="post.php?id=<?php echo $row['post_id']; ?>" class="post-link">...Read More</a>
                            </p>
                        </div>
            <?php
                        $i++;
                    }
                }
            ?>
            
        </div>
    </div>
</body>

<script src="../public/javascript/landing.js" type="text/javascript"></script>
</html>
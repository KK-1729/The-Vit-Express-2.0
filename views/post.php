<?php
    session_start();

    if( empty($_SESSION['user'])) {
        header("Location: login.php");
    }
    else {
        require_once "../config.php";
        $p_id = $_GET['id'];
        $sql1 = "SELECT * FROM posts WHERE post_id = {$p_id}";
        $result = mysqli_query($conn,$sql1) or die("Query unsuccessfull");

        while($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['post_id'];
            $user_id = $row['user_id'];
            $class = $row['class'];
            $title = $row['title'];
            $content = $row['content'];
            $image = $row['image'];
        }
        $sql1 = "SELECT user FROM users WHERE user_id = {$user_id}";
        $result = mysqli_query($conn,$sql1) or die("Query unsuccessfull");
        while($row = mysqli_fetch_assoc($result)) {
            $name = $row['user'];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/827465cdd7.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/css/post.css">
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- jquery script for comment button click -->
    <script>
        var $counter = 0;
        $(document).ready(function() {
            $("#comm").click(function() {
                if($counter == 0) {
                    $counter = 1;
                    $("#txtar").show();
                    $("#post_button").show();
                }
                else {
                    $counter = 0;
                    $("#txtar").hide();
                    $("#post_button").hide();
                }
            });
        });
    </script>
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
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <?php
                    if($_SESSION['user'] != 'admin')
                        echo '<a class="nav-link btn" href="profile.php">Profile</a>';
                    else
                        echo '<a class="nav-link btn" href="post_check.php">Check Post</a>';
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="post">
        <div class="container">
            <div class="row bc">
                <div class="col-lg-4 im">
                    <img src="image_post/<?php echo $image;?>" alt="Couldn't load image" class="post-image">
                </div>
                <div class="post-content col-lg-8">
                    <h1 class="post-title"><?php echo$title;?></h1>
                    <h3 class="post-class"><?php echo$class; ?></h3>
                    <p class="post-content con1">
                        <?php echo$content; ?>
                    </p>
                </div>
            </div>
            
            <!--Adding condition, that if the admin sees the post for approval he doesn't see the like comment and save buttons -->
            <?php
                if($_SESSION['username'] != 'admin') {
            ?>
            <p class="lead">
                <!-- BOOKMARK -->
                <a  href="../save_post.php?id=<?php echo $post_id; ?>" role="button" class="save"><i class="far fa-bookmark fa-xs"></i></a>
            <?php
                $u = $_SESSION["user_id"];
                $sq1 = "SELECT * FROM saved WHERE user_id = $u AND post_id = {$post_id}";
                if($result = mysqli_query($conn, $sq1)) {
                    $num_rows = mysqli_num_rows($result);
                }
                if($num_rows >= 1) {
            ?>
                    <style>
                        .save{display: none;}
                    </style>
                    <a  href="../unsave_post.php?id=<?php echo $post_id; ?>" role="button" class="unsave"><i class="fas fa-bookmark fa-xs bookmarked"></i></a>
                    
            <?php
                }
                else{
            ?>
                    <style>
                        .unsave{display: none;}
                    </style>
                    
            <?php
                }
            ?>                        
            <!-- LIKE BUTTON -->
            <a  href="../like_post.php?id=<?php echo $post_id; ?>" role="button" class="like"><i class="far fa-thumbs-up"></i></a>
            <?php
                $u = $_SESSION["user_id"];
                $sq1 = "SELECT * FROM likes WHERE user_id = $u AND post_id = {$post_id}";
                if($result = mysqli_query($conn, $sq1)) {
                    $num_rows = mysqli_num_rows($result);
                }
                if($num_rows >= 1) {
            ?>
                    <style>
                        .like{display: none;}
                    </style>
                    <a  href="../unlike_post.php?id=<?php echo $post_id; ?>" role="button" class="unlike"><i class="fas fa-thumbs-up"></i></a>  
            <?php
                }
                else{
            ?>
                    <style>
                        .unlike{display: none;}
                    </style>
                    
            <?php
                }
            ?>
                        
            <!-- DISLIKE BUTTON -->
            <a  href="../dislike_post.php?id=<?php echo $post_id; ?>" role="button" class="dislike"><i class="far fa-thumbs-down"></i></a>
            <?php
                $u = $_SESSION["user_id"];
                $sq1 = "SELECT * FROM dislikes WHERE user_id = $u AND post_id = {$post_id}";
                if($result = mysqli_query($conn, $sq1)) {
                    $num_rows = mysqli_num_rows($result);
                }
                if($num_rows >= 1) {
            ?>
                    <style>
                        .dislike{display: none;}
                    </style>
                    <a  href="../undislike_post.php?id=<?php echo $post_id; ?>" role="button" class="undislike"><i class="fas fa-thumbs-down"></i></a>  
            <?php
                }
                else {
            ?>
                    <style>
                        .undislike{display: none;}
                    </style>
                    
            <?php
                }
            ?>
            <br><br><br><br>
        </div>
        
        <!-- Comment feature -->
        <div class="left_icons">
            <form action="../comment.php?id=<?php echo $post_id; ?>" method="post">
                <a href="javascript:void(0)" role="button" id="comm" class="comm"><i class="far fa-comment fa-2x"></i></a>
                <textarea name="comment" id="txtar" class='btn btn-lg textarea' ></textarea>
                <input type="submit" name="submit" role="button" id="post_button" value="POST"/>
                </form>
            <?php
                }
            ?>
        </div>
        <br><br>
            <?php
                $i = 1;
                $sql = "select * from reviews where post_id='$p_id' order by rev_id DESC";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 0) {
                    echo '<h4 align="center" class="username">No Comments have been posted Yet</h4>';
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $comment = $row['comment'];
                    $date = $row['comm_date'];
                    if($i <= 6) {
                        $sql1 = "select * from users where user_id='{$user_id}'";
                        $result1 = mysqli_query($conn, $sql1);
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            $name = $row1['user'];
                            $image = $row1['pic'];
                        }
            ?>
                    <div class="container comment-tab">
                        <div class="row">
                            <div class="col-lg-1 user-avatar">
                                <img src="uploads/<?php echo $image; ?>" width="80px" viewBox="0 0 16 16" class="bi bi-person-square" fill="currentColor" />
                            </div>
                            <div class="col-lg-9 comment-details">
                                <h4 class="username"><?php echo $name; ?></h4>
                                <p class="comment"><?php echo $comment; ?></p>
                                <span class="time"><?php echo $date; ?></span>
                            </div>
                    </div>
                </div>
            <?php   
                        $i++;
                    }
                }
            ?>
        </div>
        <script src="../public/javascript/post.js" type="text/javascript"></script>
</body>
</html>

<?php
    }
?>
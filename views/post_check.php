<?php
    require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post_check</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/postcheck.css">
    <script src="https://unpkg.com/scrollreveal"></script>
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
                    <a class="nav-link btn" href="newsletter_form.php">Newsletter</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="news" style="margin-left:-50px;">
        <div class="rumour">
            <h2 class="rumour-heading">You definitely don't wanna <br>believe this!</h2>
            <?php
                $sql = "select * from posts where approval=0 and class='Rumour' order by post_id DESC";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 0) {
                    echo '<h4 align="center" class="card card-title">No Rumour Posts are Pending</h4>';
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $class = $row['class'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $image = $row['image'];
            ?>
                    <div class="card">
                        <h4 class="card-title"><?php echo $title?></h4>
                        <p class="card-text">
                                <?php echo substr($content,0,66); ?>
                            <a href="post.php?id=<?php echo substr($row['post_id'],0,20); ?>" class="post-link">...Read More</a>
                            <div class="buttons">
                                    <a href="../accept.php?id=<?php echo $row['post_id']; ?>" class="btn btn btn-success">Accept</a>
                                    <a href="../delete_post.php?id=<?php echo $row['post_id']; ?>" class="btn btn btn-danger">Reject</a>
                            </div>
                        </p>
                    </div>
            <?php
                }
            ?>
        </div>

        <div class="inner-circle"></div>
        <div class="outer-circle"></div>
        <div class="headlines" style="margin-left:-20px;margin-top:30px;">
            <h2 class="headlines-heading">Trending in VIT</h2>
            <?php
                $sql = "select * from posts where approval=0 and class='Headline' order by post_id DESC";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 0) {
                    echo '<h4 align="center" class="card card-title">No Trending Posts are Pending</h4>';
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $user_id = $row['user_id'];
                    $class = $row['class'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $image = $row['image'];  
            ?>
                    <div class="card top-card">
                        <h4 class="card-title"><?php echo $title?></h4>
                        <p class="card-text">
                                <?php echo substr($content,0,66); ?>
                            <a href="post.php?id=<?php echo $row['post_id']; ?>" class="post-link">...Read More</a>
                            <div class="buttons">
                                    <a href="../accept.php?id=<?php echo $row['post_id']; ?>" class="btn btn btn-success">Accept</a>
                                    <a href="../delete_post.php?id=<?php echo $row['post_id']; ?>" class="btn btn btn-danger">Reject</a>
                            </div>
                        </p>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
    <script src="../public/javascript/news.js" type="text/javascript"></script>
</body>
</html>
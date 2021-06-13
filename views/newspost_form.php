<?php
    require_once "../config.php";
    session_start();
    $class = $title = $content = $approval = $image = "";
    $titleerr = $contenterr = "";
    $userId = $_SESSION['user_id'];

    if(isset($_POST['submit'])) {
        if(empty(trim($_POST['title'])))
            $titleerr = "Blank Error";
        else
            $title = $_POST['title'];

        if(empty(trim($_POST['content'])))
            $contenterr = "Blank content";
        else    
            $content = $_POST['content'];
            
        if(isset($_POST['optradio'])) {
            if($_POST['optradio'] == "Rumour")
                $class = "Rumour";
            else    
                $class = "Headline";
        }

        $files = $_FILES['post_image'];
        $filename = $files['name'];
        $fileerror = $files['error'];
        $filetmp = $files['tmp_name'];
        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png', 'jpg', 'jpeg');
        if(in_array($filecheck,$fileextstored)) {
            $destinationfile = 'image_post/'.$filename;
            move_uploaded_file($filetmp,$destinationfile);
            $image = $filename;
        }
        else {
            $image = 'newsletter.png';
        }
   
        if(empty($titleerr) && empty($contenterr)) {  
            $sql = "insert into posts(user_id, class, title, content, approval, image) values ('$userId','$class','$title','$content',0,'$image')";
            mysqli_query($conn, $sql);
            if($sql) {
                header("Location: news.php" );
            }
            else
                echo "<script type=\"text/javascript\">alert('There's something wrong. Check your input again!')</script>";
        }
        else 
            echo "<script type=\"text/javascript\">alert('There's something wrong. Check your input again!')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newspost</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/newspost_form.css">
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
                    <a class="nav-link btn" href="profile.php">Profile</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="post-form">
        <div class="card">
            <section id = "inputs">

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <div class="container">
                    <div class= "row">
                        <div class = "col-md-6">
                            <p class ="ptitle">News Post</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="left col-lg-6">
                            <div class="mb-3 t1">
                                <label for="title" class="form-label">Title :-</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter tile">
                            </div>
                            <div class="mb-3 t2">
                                <label for="classtype" class="form-label">Class of your news :-</label><br>
                                <label class = "rl1"><input type="radio" name="optradio" value="Rumour" checked>Rumour</label>
                                <label class = "rl1"><input type="radio" name="optradio" value="Headline">Headline</label>
                            </div>
                            <div class="mb-3 t3">
                                <label for="image" class="form-label">Image</label><br>
                                <input type="file" name="post_image" id="post_image" accept="image/*" class="rl1">
                            </div>
                        </div>
                        <div class="right col-lg-6">
                            <div class="mb-3 t4">
                                <label for="classtype" class="form-label">Post :-</label>
                                <textarea class="form-control" name="content" rows="10" cols="15" id="post" placeholder = "Enter you news content here"></textarea>
                            </div>
                        </div>
                    </div>
                    <p class="lead">
                        <input type="submit" class="btn btn-lg" name="submit" value="POST"/>
                    </p>
                </div>
                </form>
            </section>
        </div>
    </div>
    <script src="../public/javascript/newspost_form.js" type="text/javascript"></script>
</body>
</html>
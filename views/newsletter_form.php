<?php
    include "../config.php";

    //FETCHING SUBS FROM USERS TABLE 
    $sql = "select email from users where subscriber=1";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if(isset($_POST['submit'])) {
        $head = $_POST['head'];
        $subhead1 = $_POST['subhead1'];
        $content1 = $_POST['content1'];
        $subhead2 = $_POST['subhead2'];
        $content2 = $_POST['content2'];
        $from = "thevitexpress@gmail.com";
        $subject = "The VIT Express has headlines for you!";
        //INSERTING NEWSLETTER CONTENTS TO NEWSLETTER TABLE

        if (empty($head) || empty($subhead1) || empty($content1) || empty($head) || empty($subhead2) || empty($content2))
            echo "<script>alert('Empty Field!');</script>";
        else
        {
        $sql1 = "insert into newsletter (post_date, heading, sub_heading1, content1, sub_heading2, content2) values
                (NOW(),'$head','$subhead1','$content1','$subhead2','$content2')";
        $res = mysqli_query($conn,$sql1);
        if(!$res)
            echo "<script>alert('Content not inserted!');</script>";

            //continuing fetching subscribers from users
        if($num == 0) {
            echo "<script>alert('No One has subscribed yet!');</script>";
        }
        else {
            while($row = mysqli_fetch_assoc($result)) {
                $email = $row['email'];
                $post_date = date("d/m/Y");
                $to = $email;
                $body = "
                    <html>
                    <head>
                        <style>
                            body {
                                background-color: #F1886D;
                            }
                            .newsletter {
                                background-color: #F1886D;
                                padding: 4%;
                                margin-top: 10%;
                                border-radius: 10px;
                            }
                            .newsletter-head {
                                font-family: 'Garamond', serif;
                                font-weight: bold;
                                font-weight: 700;
                                font-size: 45px;
                                color: #FFFFFF;
                                text-align: center;
                            }
                            .newsletter-subhead {
                                font-family: 'Papyrus', fantasy;
                                font-weight: 800;
                                font-size: 32px;
                                text-align: justify;
                                color: #F1886D;
                            }
                            .newsletter-text {
                                font-family: 'Brush Script MT', cursive;
                                font-weight: 500;
                                font-size: 28px;
                            }
                            .title{
                                font-family: 'Roboto', sans-serif;
                                font-weight: bold;
                                font-weight: 100;
                                font-size: 45px;
                                color: #FFFFFF;
                            }
                            .date {
                                float: right;
                            }
                            .card {
                                background-color: #FFEBE7;
                                border-radius: 20px;
                                padding-left: 3%;
                                padding-top: 1%;
                                padding-bottom: 1%;
                                margin-bottom: 3%;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='newsletter container'>
                            <h1 class='title'>The Vit Express <span class='date'>$post_date</span></h1>
                            <h1 class='newsletter-head'>$head</h1><br>
                            <div class='card'>
                                <h2 class='newsletter-subhead'>$subhead1</h2>
                                <p class='newsletter-text'>$content1</p>
                            </div>
                            <div class='card'>
                                <h2 class='newsletter-subhead'>$subhead2</h2>
                                <p class='newsletter-text'>$content2</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ";
                $headers = "From: $from \r\n";
                $headers .= "Reply-To: $from \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $sendmail = mail($to, $subject, $body, $headers);
                    if(!$sendmail) {
                        //echo "<script>alert('Email not sent. Some error occured')</script>";
                        exit("<script>alert('Email not sent. Some error occured')</script>");
                    }
                
                
            }
            echo "<script>alert('Mail sent to subscribers.')</script>";
            
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newsletter_form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/newsletter_form.css">
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
                    <a class="nav-link btn" href="post_check.php">Check Posts</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="news-form">
        <div class="card">
            <section id = "banner">
                <div class="container">
                    <div class= "row">
                        <div class = "col-md-6 n1">
                            <p class ="ptitle">Newsletter Form</p>
                        </div>
                    </div>
                </div>
            </section>
            <section id = "inputs">
                <div class="container">
                <form method="post" name="newsletter" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="mb-3 n2">
                        <label for="head" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="head" name="head" placeholder="Enter Heading">
                    </div>
                    <div class="row">
                        <div class="left-column col-lg-6">
                            <div class="mb-3 n3">
                                <label for="subhead1" class="form-label">Sub heading 1</label>
                                <input type="text" class="form-control" id="subhead1" name = "subhead1" placeholder="Enter Sub-heading 1">
                            </div>
                            <div class="mb-3 n5">
                                <label for="content1" class="form-label">Content 1</label>
                                <textarea name="content1" id="content1" name = "content1" cols="30" rows="6" placeholder="Enter content 1"></textarea>
                            </div>
                        </div>
                        <div class="right-column col-lg-6">
                            <div class="mb-3 n4">
                                <label for="subhead2" class="form-label">Sub heading 2</label>
                                <input type="text" class="form-control" id="subhead2" name = "subhead2" placeholder="Enter Sub-heading 2">
                            </div>
                            <div class="mb-3 n6">
                                <label for="content2" class="form-label">Content 2</label>
                                <textarea name="content2" id="content2" name = "content2" cols="30" rows="6" placeholder="Enter content 2"></textarea>
                            </div>
                        </div>
                    </div>
                    <p class="lead">
                    <input class = "btn btn-lg" type="submit" name='submit' value="submit"> 
                    </p>
                </form>
                </div>
            </section>
        </div>    
    </div>
    <script src="../public/javascript/newsletter_form.js" type="text/javascript"></script>
</body>
</html>
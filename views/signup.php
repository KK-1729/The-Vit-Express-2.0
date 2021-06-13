<?php
    require_once "../config.php";

    $name = $email = $pass = $pic = $subscriber = "";
    $name_err = $email_err = $pass_err = $username_err="";
    $username = $_POST['username'];
    if(isset($_POST['submit'])) {
        $sql = "select * from users where username = '{$username}'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num > 0) {
            echo "<script>alert('Username Already Taken!')</script>";
            $username_err='Error';
        }
        if(empty(trim($_POST['username']))) {
            $username_err = "Username cannot be blank";
        }
        if(empty(trim($_POST['name']))) {
            $name_err = "Name cannot be blank";
        }
        else{
            $name = trim($_POST['name']);
        }

        if(empty($_POST['pass'])) {
            $pass_err = "Name cannot be blank";
        }
        else{
            $pass = $_POST['pass'];
        }  

        $files = $_FILES['file'];
        $filename = $files['name'];
        $fileerror = $files['error'];
        $filetmp = $files['tmp_name'];
        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png','jpg','jpeg');
        if(empty($fileerror) && !empty($filename)){
            if(in_array($filecheck,$fileextstored)) {
                $destinationfile = 'uploads/'.$filename;
                move_uploaded_file($filetmp,$destinationfile);
                $pic = $filename;
            }
        }        
        if(empty($filename))
            $pic='null.png';    


        if(empty(trim($_POST["email"]))) {
                $email_err = "Email cannot be blank";
        }
        else{
            $email = trim($_POST['email']);
        }

        if(isset($_POST['agree-term'])){
            if($_POST['agree-term'] == 'true')
                $subscriber = true;
            else    
                $subscriber = false;
        }

        if(empty($username_err) && empty($name_err) && empty($email_err) && empty($pass_err)){
            $sql = "insert into users(username, user, password, pic, email, subscriber) values ('$username','$name','$pass','$pic','$email','$subscriber')";
            mysqli_query($conn, $sql);
            if($sql) {
                header("Location: login.php" );
            }
            else
            echo "Something went wrong..";
        }
        else
        {   
            if($username_err != "Error")
            echo "<script>alert('Fields cannot be left blank')</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <!-- Font Icon -->
    <link rel="stylesheet" href="../public/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="../public/css/style.css">
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
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="#">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                            <div class="form-group n1" style="margin-top: -5px;">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group n2">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Chose your username"/>
                            </div>
                            <div class="form-group n3">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group n4" style="margin-bottom: 40px;">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Chose your Password"/>
                            </div>
                            <div class="n5">   Chose your profile picture</i> <input type="file" id="img" name="file" accept="image/*"></div>
                            <div class="form-group" style="margin-top: 20px;">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" value="true" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I wish to subscribe to the newsletter!!</label>
                            </div>
                            
                            <div class="form-group form-button" style="margin-top: -30px;">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>

                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../public/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

       </div> 
       <script src="../public/javascript/signup.js" type="text/javascript"></script>
    <!-- JS -->
    <script src="../public/javascript/jquery/jquery.min.js"></script>
</body>
</html>
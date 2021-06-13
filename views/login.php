<?php
    include "../config.php";
    if(isset($_POST['signin'])) {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['your_pass']);

        echo $sql = "select user_id, username, user, password, email, pic from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($conn,$sql) or die("query failed");

        if(mysqli_num_rows($result) > 0) {
            while($rows = mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['username'] = $rows['username'];
                $_SESSION['user_id'] = $rows['user_id'];
                $_SESSION['user'] = $rows['user'];
                $_SESSION['email'] = $rows['email'];
                $_SESSION['pic'] = $rows['pic'];

                if(isset($_POST['remember-me'])) {
                    setcookie('usernamecookie',$rows['username'], time()+86400);
                    setcookie('passcookie',$rows['password'], time()+86400);
                }

                if($rows['username'] == 'admin') {
                    header("Location: post_check.php");
                }
                else
                    header("Location: news.php");  
            }
        }
        else {
            echo "<script type=\"text/javascript\">alert('Wrong credentials')</script>";
        }   
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
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
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="signup.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main ab">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container lgn">
                <div class="signin-content" >
                    <div class="signin-image">
                        <figure><img src="../public/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">New User?</a>
                    </div>

                    <div class="signin-form" style="margin-top: 40px;">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group n1">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Username"
                                value="<?php 
                                    if(isset($_COOKIE['usernamecookie'])) {
                                        echo $_COOKIE['usernamecookie'];
                                    }
                                ?>"/>
                            </div>
                            <div class="form-group n2">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"
                                value="<?php 
                                    if(isset($_COOKIE['passcookie'])) {
                                        echo $_COOKIE['passcookie'];
                                    }
                                ?>"
                                />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" value="true"/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button" style="margin-left: 60px;margin-top: 40px;">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="../public/javascript/login.js" type="text/javascript"></script>
    <!-- JS -->
    <script src="../public/javascript/jquery/jquery.min.js"></script>
</body>
</html>
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <title>Profile</title>
    <link rel="stylesheet" href="../public/css/style_profile.css">
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

    <div class="page-content page-container" id="page-content" style="margin-top: 80px;">
    <div class="padding">
        <div class="row d-flex justify-content-center" >
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full" >
                    <div class="row m-l-0 m-r-0 adj" style="height: 400px;">
                        <div class="col-sm-4 user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25" style="margin-top: 60px;"> <?php echo '<img src="uploads/',$_SESSION['pic'],'" class="img-radius" alt="User-Profile-Image" height="200px">'?> </div>
                                
                                 <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block" style="margin-top: 60px;">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600" style="font-size: 25px;">Information</h6>
                                <div class="row" style="margin-top: 50px;">
                                    <div class="col-sm-6 nm">
                                        <p class="m-b-10 f-w-600">Name<img src="../public/images/id-card.png" style="height:35px;
                                        width:30px; margin-left:20px;margin-top: -10px;"></p>
                                        <?php echo '<h6 class="text-muted f-w-400" style="font-size: 18px;">'. $_SESSION["user"]. '</h6>';?>
                                    </div>
                                    <div class="col-sm-6 nm1">
                                        <p class="m-b-10 f-w-600">Email<img src="../public/images/email.png" style="height:25px;
                                        width:30px; margin-left:20px;margin-top: 0px;"></p>
                                        <?php echo '<h6 class="text-muted f-w-400" style="font-size: 18px;">'. $_SESSION["email"]. '</h6>';?>
                                    </div>
                                </div>
                                
                                <div class="row" style="margin-top: 40px;">
                                    <div class="col-sm-6 nm2">
                                        <p class="m-b-10 f-w-600">UserName<img src="../public/images/atr.png" style="height:25px;
                                        width:30px; margin-left:10px;margin-top: -5px;"></p>
                                        <?php echo '<h6 class="text-muted f-w-400" style="font-size: 18px;">'. $_SESSION["username"]. '</h6>';?>
                                    </div>
                                    <div class="col-sm-6 nm3">
                                        <p class="m-b-10 f-w-600">Saved Posts <img src="../public/images/save-button.png" style="height:25px;
                                        width:30px; margin-left:10px;margin-top: -5px;"></p>
                                        <h6 class="text-muted f-w-400"><a href="saved_post.php" class="text-muted" style="font-size: 18px;">Check it out!</a></h6>
                                    </div>
                                </div>
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>


<script src="../public/javascript/profile.js" type="text/javascript"></script>

</body>
</html>
<?php
    require_once "config.php";
    $p_id = $_GET['id'];
    $sql1 = "UPDATE posts SET approval = true WHERE post_id = {$p_id}";
    $result = mysqli_query($conn,$sql1) or die("Query unsuccessfull");
    header("Location: views/post_check.php");
    mysqli_close($conn);
?>
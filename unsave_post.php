<?php
    require_once "config.php";
    
    session_start();

    $p_id = $_GET['id'];
    $u_id = $_SESSION['user_id'];
    $delete = "DELETE FROM saved WHERE user_id = $u_id AND post_id = $p_id";
    if(mysqli_query($conn, $delete)) {
        header("Location: views/post.php?id=$p_id");
    }
    else
        echo "<script>alert('Some error occured')</script>";
?>
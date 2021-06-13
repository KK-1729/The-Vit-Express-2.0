<?php
    require_once "config.php";

    session_start();

    $p_id = $_GET['id'];
    $u_id = $_SESSION['user_id'];
    $sql = "insert into saved (user_id,post_id) values ('$u_id','$p_id')";
    $res = mysqli_query($conn, $sql);
    if($res) {
        header("Location: views/post.php?id=$p_id" );
    }
    else
        echo "<script>alert('Some error occured')</script>";
?>

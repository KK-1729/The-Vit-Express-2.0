<?php
    require_once "config.php";

    session_start();

    $p_id = $_GET['id'];
    $u_id = $_SESSION['user_id'];
    $sql = "insert into likes (user_id,post_id) values ('$u_id','$p_id')";
    $res = mysqli_query($conn, $sql);
    $delete = "DELETE FROM dislikes WHERE user_id = $u_id AND post_id = $p_id";
    $res2 = mysqli_query($conn, $delete);
    $get_likes = "SELECT COUNT(user_id) FROM likes WHERE post_id = $p_id";
    $res3 = mysqli_query($conn, $get_likes);
    while($row = mysqli_fetch_assoc($res3)) {
        $total_likes = $row['COUNT(user_id)'];
    }
    $update_likes = "UPDATE posts SET likes = '$total_likes' WHERE post_id = $p_id";
    $res4 = mysqli_query($conn, $update_likes);
    $get_dislikes = "SELECT COUNT(user_id) FROM dislikes WHERE post_id = $p_id";
    $res5 = mysqli_query($conn, $get_dislikes);
    while($row = mysqli_fetch_assoc($res5)) {
        $total_dislikes = $row['COUNT(user_id)'];
    }
    $update_dislikes = "UPDATE posts SET dislikes = '$total_dislikes' WHERE post_id = $p_id";
    $res6 = mysqli_query($conn, $update_dislikes);
    if($res) {
        header("Location: views/post.php?id=$p_id" );
    }
    else
        echo "<script>alert('Some error occured')</script>";
?>

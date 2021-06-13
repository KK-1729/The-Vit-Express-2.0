<?php
    require_once "config.php";
    session_start();

    $p_id = $_GET['id'];
    $u_id = $_SESSION['user_id'];

    if(empty(trim($_POST["comment"]))) {
        echo "<script>alert('Comment seciton is blank')</script>";
        header("Location: views/post.php?id=$p_id" );
        
    }
    else {
        $comment = trim($_POST['comment']);
        $sql = "insert into reviews (post_id, user_id, comment, comm_date) values ('$p_id','$u_id','$comment',NOW())";
        $res = mysqli_query($conn,$sql);
                if($res) {
                    header("Location: views/post.php?id=$p_id" );
                }
                else
                    echo "<script>alert('Some error occured')</script>";

    }
?>
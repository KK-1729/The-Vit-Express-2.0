<?php
    define('DB_SERVER','sql5.freesqldatabase.com');
    define('DB_USERNAME','sql5415722');
    define('DB_PASSWORD','TFSsuEeVvr');
    define('DB_NAME','sql5415722');

    //connecting to database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($conn == false) {
        die('Error: Cannnot connect to database');
    }
?>
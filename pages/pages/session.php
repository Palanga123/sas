<?php

    require 'conn.php';

    session_start();

    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($conn, "SELECT fname, lname FROM Administrator WHERE email ='$user_check'");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    
    $loggedin_session = $row['fname'];
    $loggedin_id = $row['lname'];

    if(!isset($loggedin_session) || $loggedin_session == NULL) {
        header("Location: ../../?");
    }
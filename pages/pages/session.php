<?php
    // Import file containing database connections
    require 'conn.php';

    session_start();


    //Retrieve the user's email from the session
    $user_check = $_SESSION['login_user'];

    //Query the database to get users first and last name
    $ses_sql = mysqli_query($conn, "SELECT admin_id, fname, lname FROM Administrator WHERE email ='$user_check'");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    

    //Assigning the retrieved values to variables
    $loggedin_fname = $row['fname'];
    $loggedin_lname = $row['lname'];
    $loggedin_session = $row['admin_id'];

    //Check if the user is not logged in or logged in session is not set to empty
    if(!isset($loggedin_session) || empty($loggedin_session)) {
        // Redirect to login page

        header("Location: ../../?");
        exit;
    }
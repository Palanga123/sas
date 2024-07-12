<?php

function login()
{
    global $conn, $success;
    echo $success;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $query = "SELECT * FROM Adminstrator WHERE email ='$email' and password='$pass'";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $active = $row['active'];
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $_SESSION['login_user'] = $email;
            header("Location: ./");
        } else {
            header("Location: ../../");
        }
    } else {
        $hello = 'hello';
    }
}

function createTransporter()
{
    // Creates a new transporter profile to be stored in our database

    global $conn;

    $nrc = $_POST['nrc'];
    $result = mysqli_query($conn, "SELECT * FROM Transporter WHERE nrc ='$nrc'");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows) {

        header("location: ./?remarks=exists");
    } else {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $nrc = $_POST['nrc'];
        $finger_id = $_POST['finger_id'];
        $status = "Offline";
        $password = $_POST['password'];



        if (mysqli_query($conn, "INSERT INTO Transporter(fname, lname, email, phone, nrc, finger_id, status, password) VALUES('$fname', '$lname','$email', '$phone', '$nrc', '$finger_id', '$status', '$password');")) {

            header("location: ./?remarks=success");
        } else {
            $e = mysqli_error($conn);
            header("location: ./?remarks=error&value=$e");
        }
    }
}

function createTrunk()
{

    // Get trunk name as input and check if any other trunk has that name 
    // If not register it and if it does give error message trunk with that name exists
    global $conn;
    $trunk_name = $_POST['trunk_name'];
    $status = "Offline";
    $trunk_exists = mysqli_query($conn, "SELECT * FROM Trunks WHERE trunk_name ='$trunk_name'");

    $result_rows = mysqli_num_rows($trunk_exists);
    if ($result_rows) {
        header("Location: trunk.php?remarks=exists");
    } else {
        $sql = "INSERT INTO Trunks(trunk_name, status) VALUES('$trunk_name', '$status')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: trunk.php?remarks=success");
        } else {
            $e = mysqli_error($conn);
            header("Location: trunk.php?remarks=error&value=$e");
        }
    }
}

function assign_trunk()
{
    // Assign global variable conn as it connects us to our database
    global $conn;

    // Get trunks unique name and transporter nrc and use them 
    // Query the database for trunk id and transporters id 
    // As those are more suitable to work with
    $trunk_name = $_POST["trunk_name"];
    $transporter_nrc = $_POST["transporter_nrc"];


    $trans_sql = "SELECT transporter_id FROM Transporter WHERE nrc = '$transporter_nrc'";
    $trunk_sql = "SELECT trunk_id FROM Trunks WHERE trunk_name = '$trunk_name'";

    $trans_query = mysqli_query($conn, $trans_sql);
    $trunk_query = mysqli_query($conn, $trunk_sql);


    // Check if transporter with that nrc or trunk with that name exist
    // If they do go on to assign the trunk and register in the 
    // Transit table and have them as online
    // If they don't then it gives an error message transporter or user does not exist
    if (mysqli_num_rows($trans_query) > 0 && mysqli_num_rows($trans_query) > 0) {

        $trans_result = mysqli_fetch_array($trans_query, MYSQLI_ASSOC);
        $trunk_result = mysqli_fetch_array($trunk_query, MYSQLI_ASSOC);

        $trunk_id = $trunk_result['trunk_id'];
        $transporter_id = $trans_result['transporter_id'];

        $destination = $_POST['destination'];
        $cargo = $_POST['cargo'];

        if ($trunk_query && $trans_query) {

            $transit_sql = "INSERT INTO `Transit`(depature, destination, cargo, trunk_id, transporter_id) VALUES('Lusaka', '$destination', '$cargo', '$trunk_id', '$transporter_id')";
            $transit_result = mysqli_query($conn, $transit_sql);

            if ($transit_result) {

                $update_sql = "UPDATE `Transporter` SET status = 'Online' WHERE transporter_id = '$transporter_id'";
                $update = mysqli_query($conn, $update_sql);

                $update_trunk_sql = "UPDATE `Trunks` SET status = 'Online' WHERE trunk_id = '$trunk_id'";
                $update_trunk = mysqli_query($conn, $update_trunk_sql);

                if ($update && $update_trunk) {
                    header("Location: trunk.php?remarks=successful");
                }
            } else {
                header("Location: trunk.php?remarks=reg_error");
            }
        } else {
            header("Location: trunk.php?remarks=user_exists");
        }
    } else {
        header("Location: trunk.php?remarks=doesnt_exist");
    }
}

function calculateTimeDifference($timestamp)
{
    // Calculates the difference in time between 
    // the time of the alert and current time

    // Get current time and subtract it from the parameter being parsed
    $currentTime = time();
    $difference = $currentTime - $timestamp;
    $new_time = floor($difference / 60);

    // Assign the time to check how long ago the event happened in days, months or years
    if ($new_time == 0) {
        return "Just now";
    } elseif ($new_time < 60) {
        return "$new_time minute" . ($new_time > 1 ? 's' : '') . " ago";
    } elseif ($new_time < 1440) {
        $hours = floor($new_time / 60);
        return "$hours hour" . ($hours > 1 ? 's' : '') . " ago";
    } elseif ($new_time < 43200) {
        $days = floor($new_time / 1440);
        return "$days day" . ($days > 1 ? 's' : '') . " ago";
    } elseif ($new_time < 525600) {
        $months = floor($new_time / 43200);
        return "$months month" . ($months > 1 ? 's' : '') . " ago";
    } else {
        $years = floor($new_time / 525600);
        return "$years year" . ($years > 1 ? 's' : '') . " ago";
    }
}

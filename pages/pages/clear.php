<?php
include "conn.php";
$transporter_id = $_POST['id'];

$query = "SELECT trunk_id FROM `Transit` WHERE transporter_id = $transporter_id";
$action = mysqli_query($conn, $query);
$action_row = mysqli_fetch_assoc($action);
$trunk_id = $action_row['trunk_id'];

$sql = "UPDATE `Transit` SET state = 'Offline' WHERE transporter_id = $transporter_id";
$result = mysqli_query($conn, $sql);
$sql2 = "UPDATE `Transporter` SET status = 'Offline' WHERE transporter_id = $transporter_id";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "UPDATE `Trunks` SET status = 'Offline' WHERE trunk_id = $trunk_id";
$result3 = mysqli_query($conn, $sql3);


if ($result && $result2 && $result3) {
    header("Location: transit.php?");
    // echo $trunk_id, $transporter_id;
}

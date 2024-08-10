<?php
include "conn.php";
$transit_id = $_POST['id'];

$query = "SELECT trunk_id, transporter_id FROM `Transit` WHERE transit_id = $transit_id";
$action = mysqli_query($conn, $query);
$action_row = mysqli_fetch_assoc($action);
$trunk_id = $action_row['trunk_id'];
$transporter_id = $action_row['transporter_id'];

$sql = "UPDATE `Transit` SET state = 'Offline' WHERE transit_id = $transit_id";
$result = mysqli_query($conn, $sql);
$sql2 = "UPDATE `Transporter` SET status = 'Offline' WHERE transporter_id = $transporter_id";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "UPDATE `Trunks` SET status = 'Offline' WHERE trunk_id = $trunk_id";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "DELETE FROM `Alerts` WHERE trunk_id = $trunk_id AND transporter_id = $transporter_id";
$result4 = mysqli_query($conn, $sql4);


if ($result && $result2 && $result3 && $result4) {
    header("Location: transit.php?");
    // echo $trunk_id, $transporter_id;
}

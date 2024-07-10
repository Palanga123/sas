
<?php
    require_once 'conn.php';
    function calculateTimeDifference($timestamp) {
        $currentTime = time();
        $difference = $currentTime - $timestamp;
        $new_time = floor($difference / 60);
    
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
    if(! $id = $_POST["id"]){
        // header("Location: transit.php?");
        echo "<script>history.back()</script>";
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../css/css.js"></script>
    <link rel="stylesheet" href="../css/fa/css/all.min.css">
    <title>Report</title>
</head>

<style>
    body {
        font-family: montserrat;
    }

    img {
        display: block;
        align-self: center;
    }
</style>

<?php
$sql = "SELECT * FROM `sas`.`Transporter` WHERE transporter_id = '$id'";
$sqlresult = $conn->query($sql);

if ($sqlresult) {
    $sqlrow = $sqlresult->fetch_assoc();
    $sqlfname = $sqlrow['fname'];
    $sqllname = $sqlrow['lname'];

    $trans_query = "SELECT * FROM `sas`.`Transit` WHERE transporter_id = '$id'";
    $trans_result = mysqli_query($conn, $trans_query);
    $trans_row = mysqli_fetch_assoc($trans_result);
    $destination = $trans_row['destination'];
    $trunk_id = $trans_row['trunk_id'];

    $more_query = "SELECT * FROM `sas`.`Trunks` WHERE trunk_id = '$trunk_id'";
    $more_result = mysqli_query($conn, $more_query);
    $more_row = mysqli_fetch_assoc($more_result);
    $trunk_name = $more_row['trunk_name'];
}
?>

<body class="w-4/5 m-auto text-gray-800">
    <img src="../images/th.jpeg" class="m-auto h-14 w-14" alt="Lock icon">
    <p class="text-2xl text-gray-800 font-bold text-center">Secure Alert System</p>

    <p class="font-semibold text-gray-800 underline underline-offset-4 py-8">Transit Detatils</p>
    <div class="flex justify-between py-2">
        <p class="font-semibold">Trunk Name: </p>
        <p><?php echo $trunk_name; ?></p>
    </div>
    <div class="flex justify-between py-2">
        <p class="font-semibold">Destinatioon:</p>
        <p><?php echo $destination; ?></p>
    </div>

    <div class="flex justify-between py-2">
        <p class="font-semibold">Transporter: </p>
        <p><?php echo "$sqlfname $sqllname"; ?></p>
    </div>
    <div class="flex justify-between py-2">
        <p class="font-semibold">Cargo: </p>
        <p>Past papers</p>
    </div>
    <div class="flex justify-between py-2">
        <p class="font-semibold">Status: </p>
        <p>Okay</p>
    </div>





    <div>
        <p class="font-semibold text-gray-800 underline underline-offset-4 py-8">Alerts:</p>
    </div>

    <?php 
                        
                        $alert_sql = "SELECT * FROM Alerts  WHERE trunk_id='$trunk_id'";
                        $alert_result = mysqli_query($conn, $alert_sql);
                        $rows = mysqli_num_rows($alert_result);

                        if($rows > 0) {

                        while ($alert_row = mysqli_fetch_assoc($alert_result)){
                            $alert_type = $alert_row["alert_type"];
                            $alert_msg = $alert_row["alert_msg"];
                            $alert_time = $alert_row["Time_stamp"];

                            if($alert_type == "green"){
                                $icon = "fa-check-circle";
                                $color = "text-green-600";
                            }else if($alert_type == "red"){
                                $icon = "fa-exclamation-triangle";
                                $color = "text-red-600";
                            }else if($alert_type == "orange"){
                                $icon = "fa-exclamation-triangle";
                                $color = "text-orange-600";
                            }else{
                                $icon = "fa-check-circle";
                                $color = "text-green-600";
                            }                            

                            $at = strtotime($alert_time);
                            $display = calculateTimeDifference($at);
                        
                            ?>

    <div class="px-4 py-6 my-2 flex cursor-pointer border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
        <div class="text-2xl md:text-4xl <?php echo $color; ?> px-2 md:px-6">
            <i class="fa-solid <?php echo $icon; ?>"></i>
        </div>
        <div class="px-4 font-semibold">
            <p><?php echo $alert_msg ?></p>
            <p class="text-xs text-blue-900 pt-2" id="time"><?php echo $display; ?></p>
        </div>
    </div>
        <?php
            }
            }else{
                ?>
                    <p class="text-center font-semibold text-gray-900 pt-2">No new notifications</p>
                <?php
            }

                ?>

</body>

<script>
    window.onload = print();
</script>

</html>

<?php } ?>
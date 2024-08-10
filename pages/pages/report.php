
<?php
    require_once 'conn.php';
    include 'functions.php';


    if(! $transit_id = $_POST["id"]){
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
$trans_query = "SELECT * FROM `sas`.`Transit` WHERE transit_id = '$transit_id'";
$trans_result = $conn -> query($trans_query);

if ($trans_result) {
    $trans_row = $trans_result -> fetch_assoc();
    $destination = $trans_row['destination'];
    $cargo = $trans_row['cargo'];
    $trunk_id = $trans_row['trunk_id'];
    $transporter_id = $trans_row['transporter_id'];

    
    $sql = "SELECT * FROM `sas`.`Transporter` WHERE transporter_id = '$transporter_id'";
    $sqlresult = $conn->query($sql);
    $sqlrow = $sqlresult->fetch_assoc();
    $sqlfname = $sqlrow['fname'];
    $sqllname = $sqlrow['lname'];
    

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
        <p><?php echo $cargo; ?></p>
    </div>
    <div class="flex justify-between py-2">
        <p class="font-semibold">Status: </p>
        <p>Okay</p>
    </div>





    <div>
        <p class="font-semibold text-gray-800 underline underline-offset-4 py-8">Alerts:</p>
    </div>

    <?php 
                        // Query the database to check if there are alerts in the databse
                        $alert_sql = "SELECT * FROM Alerts  WHERE trunk_id='$trunk_id'";
                        $alert_result = mysqli_query($conn, $alert_sql);
                        $rows = mysqli_num_rows($alert_result);

                        // If there are results display them by iterating through each item
                        if($rows > 0) {

                        while ($alert_row = mysqli_fetch_assoc($alert_result)){
                            $alert_type = $alert_row["alert_type"];
                            $alert_msg = $alert_row["alert_msg"];
                            $alert_time = $alert_row["timestamp"];

                            // Check what type of alert it is 
                            // 100 - for vibrations
                            // 200 - for Light intensity
                            if($alert_type == "100" || $alert_type == "200"){
                                $icon = "fa-check-circle";
                                $color = "text-green-600";
                            }else if($alert_type == "101" || $alert_type == "201"){
                                $icon = "fa-exclamation-triangle";
                                $color = "text-red-600";
                            }else{
                                $icon = "fa-check-circle";
                                $color = "text-orange-600";
                            }   
                            // echo date('Y-m-d H:i:s', $alert_time);
                            $at = strtotime($alert_time);
                            $display = calculateTimeDifference($at);
                        
                            ?>

    <div class="px-4 py-6 my-2 mb-4 flex cursor-pointer border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
        <div class="text-2xl md:text-4xl <?php echo $color; ?> px-2 md:px-6">
            <i class="fa-solid <?php echo $icon; ?>"></i>
        </div>
        <div class="px-4 font-semibold">
            <p><?php echo $alert_msg ?></p>
            <p class="text-xs text-blue-900 pt-2" id="time"><?php echo "$alert_time --- $display"; ?></p>
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
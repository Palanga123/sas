<?php

    $title = "Transit";
    include 'base.php';
    include 'functions.php';
    
    if(! $id = $_GET["id"]){
        echo "<script>history.back()</script>";
    }else{
?>
<head>
    
<body>
    <main class="w-11/12 md:w-5/6 mx-auto md:px-10 py-2">    
            <div id="user" class="w-full">
                <?php
                    
                    // Display transporter details by getting the id sent by trunks.php
                    // If there are any results it will display
                    $sql = "SELECT * FROM `sas`.`Transporter` WHERE transporter_id = '$id'";
                    $sqlresult = $conn -> query($sql);

                    if($sqlresult){
                        $sqlrow = $sqlresult -> fetch_assoc();
                        $sqlfname = $sqlrow['fname'];
                        $sqllname = $sqlrow['lname'];

                        $trans_query = "SELECT * FROM `sas`.`Transit` WHERE transporter_id = '$id'";
                        $trans_result = mysqli_query($conn, $trans_query);
                        $trans_row = mysqli_fetch_assoc($trans_result);
                        $destination = $trans_row['destination'];
                        $trunk_id = $trans_row['trunk_id'];
                ?>
                <div class="w-full rounded-md shadow-md overflow-hidden bg-white my-5">
                    <div class="md:flex justify-between text-center p-2 font-semibold text-gray-800">
                        <div class = "md:w-1/2 px-4 py-4 rounded-md text-left items-center"><i class="fa-solid fa-user-circle pr-2 md:px-4 text-[20px] text-sky-800"></i><?php echo "$sqlfname $sqllname: $destination"; ?></div>
                        <div class="flex ">
                            <div class = "px-4 md:px-4 py-2 md:py-4 rounded-md cursor-pointer ml-2 border border-sky-600 bg-sky-50 links" id="default" onclick="tabing(event, 'map')">Map</div>
                            <div class = "px-4 md:px-4 py-2 md:py-4 rounded-md cursor-pointer ml-2 border border-sky-600 bg-sky-50 links" onclick="tabing(event, 'not')">Alerts</div>
                            <div class = "px-4 md:px-4 py-2 md:py-4 rounded-md cursor-pointer ml-2 border border-sky-600 bg-sky-50">
                                <form action="report.php" method="post">
                                    <input type="text" name="id" value="<?php echo $id ?>" class="hidden">
                                    <button class="w-full h-full">Report</button>
                                </form>
                                
                            </div>
                        </div>
                        <div class = "hidden md:w-1/6 px-4 py-4 hover:bg-red-500 rounded-md cursor-pointer ml-2 bg-red-600 text-white" onclick="location.href = 'transit.php'">Exit</div>
                    </div>
                </div>
                <input id="user_id" value="<?php echo $trunk_id?> " name="id" class="hidden">
                <div class="w-full h-[500px] overflow-hidden rounded-md mt-8 shadow-2xl">
                    <div id="map" class="tabContent h-full w-full a"></div>

                    <div id="not" class="tabContent">
                            
                        <?php 
                        
                        $alert_sql = "SELECT * FROM Alerts  WHERE trunk_id='$trunk_id'";
                        $alert_result = mysqli_query($conn, $alert_sql);
                        $rows = mysqli_num_rows($alert_result);

                        if($rows > 0) {

                        while ($alert_row = mysqli_fetch_assoc($alert_result)){
                            $alert_type = $alert_row["alert_type"];
                            $alert_msg = $alert_row["alert_msg"];
                            $alert_time = $alert_row["timestamp"];

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

                    
                            $at = strtotime($alert_time);
                            $display = calculateTimeDifference($at);
                        
                            ?>
                                <div class="px-4 py-6 my-2 flex cursor-pointer border-l-8 border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
                                    <div class="text-2xl md:text-4xl <?php echo $color;?> px-2 md:px-6">
                                        <i class="fa-solid <?php echo $icon;?> "></i>
                                    </div>
                                    <div class="px-4 font-semibold"> 
                                        <p><?php echo $alert_msg;?> </p>
                                        <p class="text-xs text-blue-900 pt-2" id="time"><?php echo "$alert_time --- $display"; ?> </p>
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
                
                
                    
                    </div>
            
                </div>
                    </div>
    </main>
</body>
    <script src="../JavaScript/header.js"></script>
    <script src="../JavaScript/toggle.js"></script>
    <script src="../JavaScript/gps_track.js"></script>

<?php 
            
        }else{
            echo "error";
        } 
    }?>
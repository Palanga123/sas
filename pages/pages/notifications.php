<?php
    $title = "Notifications";
    include 'base.php' ;
    include 'functions.php';
    
?>
    <main class="w-11/12 md:w-3/5 m-auto">
        
        <div id="notInfo" class="w-full">
            <div class="border-b bg-white rounded-md px-10 py-3 md:py-6 my-5">
                <p class="font-semibold text-2xl text-slate-900">Notifications</p>
            </div>
            
            <div class="py-8">
                <button class="px-4 py-2 rounded bg-white shadow links ml-2" id="default" onclick="tabing(event, 'unread')">New</button>
                <button class="px-4 py-2 rounded bg-white shadow links" onclick="tabing(event, 'read')">All</button>
            </div>

            <div class="text-sm text-gray-800 tabContent" id="unread">
                <?php                 

                // Query the database to check if there are alerts in the databse
                $alert_sql = "SELECT * FROM Alerts WHERE state = 'Unread' ORDER BY alert_id DESC";
                $alert_result = mysqli_query($conn, $alert_sql);
                $rows = mysqli_num_rows($alert_result);

                // If there are results display them by iterating through each item
                if($rows > 0) {

                    
                    while ($alert_row = mysqli_fetch_assoc($alert_result)){
                        $transporter_id = $alert_row["transporter_id"];
                        $alert_type = $alert_row["alert_type"];
                        $alert_msg = $alert_row["alert_msg"];
                        $alert_time = $alert_row["timestamp"];
                        $alert_state = $alert_row["state"];

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
                            <div class="px-4 py-6 my-2 flex cursor-pointer border-l-8 border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
                            <div class="text-2xl md:text-4xl <?php echo $color;?> px-2 md:px-6">
                                <i class="fa-solid <?php echo $icon;?> "></i>
                            </div>
                            <div class="flex justify-between w-full">
                                <div class="px-4 font-semibold"> 
                                    <p><?php echo $alert_msg;?> </p>
                                    <p class="text-xs text-blue-900 pt-2" id="time"><?php echo "$alert_time --- $display";?> </p>
                                    
                                </div> 
                                <form action="details.php" method="get" class="text-right">
                                        <input type="text" value="<?php  echo $transporter_id;?>" name="id" class="hidden">
                                        <button type="submit" class="text-white text-sm py-2 px-3 rounded-md bg-sky-700 text-right">View</button>
                                </form>
                            </div>
                        </div>
                        <?php
                        }

                        
                        ?>
                        
                    <?php

                    
                }else{
                    echo '<p class="text-center font-semibold text-gray-900 pt-2">No new notifications </p>';
                }
                    ?>
                
                
            </div>
            <div class="text-sm text-gray-800 tabContent" id="read">
                <?php                 

                // Query the database to check if there are alerts in the databse
                $alert_sql = "SELECT * FROM Alerts WHERE state = 'read' ORDER BY alert_id DESC";
                $alert_result = mysqli_query($conn, $alert_sql);
                $rows = mysqli_num_rows($alert_result);

                // If there are results display them by iterating through each item
                if($rows > 0) {

                    
                    while ($alert_row = mysqli_fetch_assoc($alert_result)){
                        $alert_type = $alert_row["alert_type"];
                        $transporter_id = $alert_row["transporter_id"];
                        $alert_msg = $alert_row["alert_msg"];
                        $alert_time = $alert_row["timestamp"];
                        $alert_state = $alert_row["state"];

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
                            <div class="px-4 py-6 my-2 flex cursor-pointer border-l-8 border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
                            <div class="text-2xl md:text-4xl <?php echo $color;?> px-2 md:px-6">
                                <i class="fa-solid <?php echo $icon;?> "></i>
                            </div>
                            <div class="flex justify-between w-full">
                                <div class="px-4 font-semibold"> 
                                    <p><?php echo $alert_msg;?> </p>
                                    <p class="text-xs text-blue-900 pt-2" id="time"><?php echo "$alert_time --- $display";?> </p>
                                    
                                </div> 
                            </div>
                        </div>
                        <?php
                        }

                        
                        ?>
                        
                    <?php

                    
                }else{
                    echo '<p class="text-center font-semibold text-gray-900 pt-2">No read notifications </p>';
                }
                    ?>
                
                
            </div>
            
        </div>
    
    </main>
    </body>
    </html>
    <script>
        document.getElementById("alerts").classList.add("bg-sky-200")
    </script>
    <script src="../JavaScript/header.js"></script>
    <script src="../JavaScript/toggle.js"></script>
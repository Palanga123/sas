<?php
    $title = "Notifications";
    include 'base.php' ;

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
?>
    <main class="w-11/12 md:w-3/5 m-auto">
        
        <div id="notInfo" class="w-full">
            <div class="border-b bg-white rounded-md px-10 py-3 md:py-6 my-5">
                <p class="font-semibold text-2xl text-slate-900">Notifications</p>
            </div>
            
            <div class="text-sm text-gray-800">
                <?php 
                
                $alert_sql = "SELECT * FROM Alerts";
                $alert_result = mysqli_query($conn, $alert_sql);
                $rows = mysqli_num_rows($alert_result);

                if($rows > 0) {

                    while ($alert_row = mysqli_fetch_assoc($alert_result)){
                        $alert_type = $alert_row["alert_type"];
                        $transporter_id = $alert_row["transporter_id"];
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
                        <div class="px-4 py-6 my-2 flex cursor-pointer border-l-8 border border-sky-600 bg-sky-50 rounded-md mx-1 items-center">
                            <div class="text-2xl md:text-4xl <?php echo $color;?> px-2 md:px-6">
                                <i class="fa-solid <?php echo $icon;?> "></i>
                            </div>
                            <div class="flex justify-between w-full">
                                <div class="px-4 font-semibold"> 
                                    <p><?php echo $alert_msg;?> </p>
                                    <p class="text-xs text-blue-900 pt-2" id="time"><?php echo $display;?> </p>
                                    
                                </div> 
                                <form action="details.php" method="get" class="text-right">
                                        <input type="text" value="<?php  echo $transporter_id;?>" name="id" class="hidden">
                                        <button type="submit" class="text-white text-sm py-2 px-3 rounded-md bg-sky-700 text-right">View</button>
                                </form>
                            </div>
                        </div>
                    <?php

                    }

                }else{
                    echo '<p class="text-center font-semibold text-gray-900 pt-2">No new notifications </p>';
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
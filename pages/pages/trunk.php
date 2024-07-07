<?php $title = "Security Alert System"; include 'base.php' ?>
    <main class="w-11/12 md:w-2/3 mx-auto bg-white mt-10 rounded-md overflow-hidden shadow-md">
        
        <div class="w-full overflow-hidden">
            <div class="flex justify-evenly text-center font-semibold text-white text-sm md:text-base">
                <div class = "links w-1/3 px-4 py-4 border-r text-sky-600 rounded-t-md cursor-pointer bg-sky-50" id="default" onclick="tabing(event, 'regInfo')">Register</div>
                <div class = "links w-1/3 px-4 py-4 border-r text-sky-600 rounded-t-md cursor-pointer bg-sky-50" id="assign_btn" onclick="tabing(event, 'assign')">Assign</div>
                <div class = "links w-1/3 px-4 py-4 text-sky-600 rounded-t-md cursor-pointer bg-sky-50" onclick="tabing(event, 'transporters')">Active</div>
            </div>
        </div>

        <div id="regInfo" class="tabContent">
            <div class="m-auto bg-white overflow-hidden">
                <div class="border-b border-gray-300 px-10 py-6">
                    <p class="font-semibold text-sm md:text-2xl text-slate-700">Trunk Registration</p>
                    <p class="text-sm text-sky-600">Register trunks to monitor them</p>
                </div>
                <div class="py-5 px-10 text-black">                    
                    <?php
                        if ($remarks == "") {
                            //dummy datat
                        }
                        if ($remarks == 'success'){
                            echo '<p class="rounded-md px-6 py-3 border border-green-600 bg-green-50 text-green-600 font-semibold">Trunk registered succesfully</p>';
                        }
                        if ($remarks == 'exists'){
                            echo '<p class="rounded-md px-6 py-3 border border-orange-500 bg-orange-50 text-orange-500 font-semibold">Trunk with that name already exists</p>';
                        }
                        if ($remarks == 'error'){
                            echo '<p class="rounded-md px-6 py-3 border border-red-600 bg-red-50 text-red-600 font-semibold">Registration error. Try again later!</p>';
                        }
                    ?>
                    <form action="new_trunk.php" method="POST">
                        <div class="md:flex py-4">
                            <div class="mr-2">
                                <p class="text-[15px]">Trunk Name</p>
                                <input type="text" placeholder="Trunk Name" class="bg-gray-50 text-sm h-10 pl-4 w-full md:w-80  mb-2 md:mb-0 rounded border border-gray-400" name="trunk_name">
                            </div>                                                        
                        </div> 
                                            
                        <div class="">
                            <button class="w-full md:w-32 my-4 py-2 font-semibold rounded bg-sky-600 text-white" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="assign" class="tab tabContent">
            <div class="m-auto bg-white overflow-hidden">
                <div class="border-b border-gray-300 px-10 py-6">
                    <p class="font-semibold text-sm md:text-2xl text-slate-700">Trunk Assignment</p>
                    <p class="text-sm text-sky-600">Assign trunks to transporters</p>
                </div>
                <div class="py-5 px-10 text-black">
                    <?php
                        if ($remarks != "") {

                            if ($remarks == 'successful'){
                                echo '<p class="rounded-md px-6 py-3 border border-green-600 bg-green-50 text-green-600 font-semibold">Transporter registered succesfully</p>';
                            }
                            if ($remarks == 'user_exists'){
                                echo '<p class="rounded-md px-6 py-3 border border-orange-500 bg-orange-50 text-orange-500 font-semibold">Transporter or Trunk doesnt exists. Make sure you have the correct details </p>';
                            }
                            if ($remarks == 'reg_error'){
                                echo '<p class="rounded-md px-6 py-3 border border-red-600 bg-red-50 text-red-600 font-semibold">Error encountered while assigning trunk. Try again later!</p>';
                            }
                        }
                        
                    ?>
                    <form action="trunk.assign.php" method="POST">
                        <div class="md:flex py-4">
                            <div class="mr-2">
                                <p class="text-[15px]">Trunk name</p>
                                <input type="text" placeholder="Trunk name" class="bg-gray-50 text-sm h-10 pl-4 w-full md:w-80  mb-2 md:mb-0 rounded border border-gray-400" name="trunk_name">
                            </div>
                            
                            <div class="mr-2">
                                <p class="text-[15px]">Transporter NRC</p>
                                <input type="text" placeholder="Transporter NRC" class="bg-gray-50 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="transporter_nrc">
                            </div>
                        
                                                        
                        </div>
                        <div class="md:flex py-4">
                            <div class="mr-2">
                                <p class="text-[15px]">Destination Town</p>
                                <select name="destination" id="destination"  class="bg-gray-50 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400 mb-2 md:mb-0">
                                    <option value="Kitwe" selected>Kitwe</option>
                                    <option value="Livingstone">Livingstone</option>
                                    <option value="Mazabuka">Mazabuka</option>
                                </select>
                            </div>
                            
                            <div class="mr-2">
                                <p class="text-[15px]">Time to be opened</p>
                                <input type="datetime-local" name="date_time" id="date_time" class="bg-gray-50 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400">
                            </div>
                                                
                        </div>             
                        
                        <div class="">
                            <button class="w-full md:w-32 my-4 py-2 font-semibold rounded bg-sky-600 text-white" type="submit">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="transporters" class="w-full rounded-md shadow-2xl overflow-hidden tabContent">
            <div class="px-10 py-6">
                <p class="font-semibold text-2xl text-gray-800">Trunks List</p>
                <p class="text-sm text-gray-600">List of all trunks on transit</p>
            </div>
            <div class="flex w-full bg-gray-300 justify-evenly overflow-hidden border-b font-semibold text-[15px] text-gray-800">
                <div class="w-1/4 px-4 py-2">Name</div>
                <div class="w-1/4 px-4 py-2">NRC No</div>
                <div class="w-1/4 px-4 py-2">Phone No</div>
                <div class="w-1/4 px-4 py-2">Status</div>
            </div>
            <div class="overflow-auto scroll-smooth h-[350px]">
                <?php
                    $query = "SELECT * FROM `sas`.`Trunks` WHERE status = 'Online'";
                    $result = mysqli_query($conn, $query);
                    
                    
                    if($result){
                        while($row = $result -> fetch_assoc()){
                        
                            $trunk_id = $row['trunk_id'];
                            $trunk_name = $row['trunk_name'];
                            $status = $row['status'];

                            $trans_query = "SELECT transporter_id FROM `sas`.`Transit` WHERE trunk_id = '$trunk_id'";
                            $trans_result = mysqli_query($conn, $trans_query);
                            $trans_row = mysqli_fetch_assoc($trans_result);
                            $transporter_id = $trans_row['transporter_id']
                ?>
                    <div class="flex w-full justify-evenly text-[15px] border-b border-gray-200 text-[13px] bg-white">
                        <div class="w-1/4 px-4 py-4"><?php echo "$trunk_id"; ?></div>
                        <div class="w-1/4 px-4 py-4"><?php echo "$trunk_name"; ?></div>
                        <div class="w-1/4 px-4 py-4"><?php echo "$status" ?></div>
                        <div class="w-1/4 px-4 py-4">
                            <form action="details.php" method="get" class="text-right">
                                <input type="text" value="<?php  echo $transporter_id;?>" name="id" class="hidden">
                                <button type="submit" class="text-white text-sm py-2 px-3 rounded-md bg-sky-700 text-right">View</button>
                            </form>
                        </div>
                    </div>
                <?php
                        }
                    }else{
                        echo'<p class="py-6 text-center text-gray-800 font-semibold italic">No Active Trunks</p>';
                    }
                ?>
            </div>
        
        </div>


        
        
    </main>
    <?php 
        
        echo '<script src="../JavaScript/toggle.js"></script>';
        if($remarks == "successful" || $remarks == "user_exists" || $remarks == "reg_error"){
            echo '
                <script>
                    document.getElementById("assign_btn").click()
                </script>';
        }

    ?>
    <script>
        document.getElementById("trunks").classList.add("bg-sky-200")
    </script>
    <script src="../JavaScript/header.js"></script>
    </body>
    </html>
    
<?php 
    $title = "Security Alert System"; 
    include 'base.php';
    
?>
    <main class="w-11/12 md:w-2/3 mx-auto bg-white my-5 rounded-md overflow-hidden shadow-md">
        
        <div class="w-full overflow-hidden">
            <div class="flex justify-evenly text-center font-semibold text-white text-xs md:text-base">
                <div class = "links w-1/3 px-4 py-3 md:py-4 border-r text-sky-600 rounded-t-md cursor-pointer bg-sky-50" id="default" onclick="tabing(event, 'regInfo')">Register</div>
                <div class = "links w-1/3 px-4 py-3 md:py-4 border-r text-sky-600 rounded-t-md cursor-pointer bg-sky-50" onclick="tabing(event, 'transporters')">Transporter List</div>
                <div class = "links w-1/3 px-4 py-3 md:py-4 text-sky-600 rounded-t-md cursor-pointer bg-sky-50" onclick="tabing(event, 'active')">Active</div>
            </div>
        </div>

        
        <div id="regInfo" class="tabContent">
            <div class="m-auto bg-white overflow-hidden">
                <div class="border-b border-gray-300 px-4 md:px-10 py-6">
                    <p class="font-semibold md:text-2xl text-slate-700">Transporter Registration Form</p>
                    <p class="text-sm text-sky-600">Register transporters to give them access to the secure system</p>
                </div>
                <div class="py-5 px-10 text-black">
                    <?php
                        if ($remarks != ""){

                            if ($remarks == 'success'){
                                echo '<p class="rounded-md px-6 py-3 border border-green-600 bg-green-50 text-green-600 font-semibold">Transporter registered succesfully</p>';
                            }
                            if ($remarks == 'exists'){
                                echo '<p class="rounded-md px-6 py-3 border border-orange-500 bg-orange-50 text-orange-500 font-semibold">Transporter with that NRC already exists, </p>';
                            }
                            if ($remarks == 'error'){
                                echo '<p class="rounded-md px-6 py-3 border border-red-600 bg-red-50 text-red-600 font-semibold">Registration error. Try again </p>';
                            }
                        }
                        
                    ?>
                    <form action="new_user.php" method="post">
                        <div class="md:flex justify-between py-4">
                            <div class="mb-3 md:mb-0">
                                <p class="text-[15px]">First name</p>
                                <input type="text" placeholder="First Name" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="fname">
                            </div>
                            
                            <div>
                                <p class="text-[15px]">Last name</p>
                                <input type="text" placeholder="Last Name" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="lname">
                            </div>
                        </div>
                        <div class="md:flex justify-between py-4">
                            <div class="mb-3 md:mb-0">
                                <p class="text-[15px]">Phone number</p>
                                <input type="text" placeholder="Phone number" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="phone">
                            </div>
                            
                            <div>
                                <p class="text-[15px]">Email address</p>
                                <input type="email" placeholder="Email address" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="email">
                            </div>
                        </div>             
                        <div class="md:flex justify-between py-4">
                            <div class="mb-3 md:mb-0">
                                <p class="text-[15px]">NRC number</p>
                                <input type="text" placeholder="NRC number" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="nrc">
                            </div>
                            
                            <div>
                                <p class="text-[15px]">Fingerprint ID</p>
                                <input type="text" placeholder="Fingerprint ID" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="finger_id">
                            </div>
                        </div>
                        <div class="md:flex justify-between py-4">
                            <div>
                                <p class="text-[15px]">Password</p>
                                <input type="password" placeholder="Password" required class="bg-gray-100 text-sm h-10 pl-4 w-full md:w-80 rounded border border-gray-400" name="password">
                            </div>
                        </div>     
                                        
                        <div class="text-right">
                            <button class="w-full md:w-32 my-4 py-2 px-4 font-semibold rounded bg-sky-600 text-white" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="transporters" class="w-full rounded-md shadow-2xl  tabContent">
            <div class="px-10 py-6">
                <p class="font-semibold text-2xl text-gray-800">Transporter List</p>
                <p class="text-sm text-gray-600">List of all registered transporters in the system.</p>
            </div>
            <div class="overflow-auto scroll-smooth">
                <div class="text-xs flex md:w-full bg-gray-300 md:justify-evenly items-center border-b font-semibold text-[15px] text-gray-800">
                    <div class="w-44 text-center py-2">Name</div>
                    <div class="w-44 text-center py-2">NRC No</div>
                    <div class="w-44 text-center py-2">Phone No</div>
                    <div class="w-44 text-center py-2">Status</div>
                </div>
                <div class="h-[350px]">
                    <?php
                    // Query the database to get transporter information
                        $query = "SELECT * FROM `sas`.`Transporter`";
                        $result = mysqli_query($conn, $query);
                        $transRows = mysqli_num_rows($result);

                        if($transRows){
                        
                            // Iterate throught the rows to make get all transporter details
                            while($row = $result -> fetch_assoc()){
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $phone = $row['phone'];
                                $nrc = $row['nrc'];
                                $status = $row['status'];
                    ?>
                        <div class="md:text-sm flex md:w-full md:justify-evenly border-b border-gray-200 text-[12px] items-center bg-white overflow-auto scroll-smooth">
                            <div class="w-44 text-center border-r py-4"><?php echo "$fname $lname"; ?></div>
                            <div class="w-44 text-center border-r py-4"><?php echo "$nrc"; ?></div>
                            <div class="w-44 text-center border-r py-4"><?php echo "$phone"; ?></div>
                            <?php if($status == "Online"){?>
                                <div class="w-44 text-center py-4 text-green-600 font-semibold"><?php echo "$status"; ?></div>
                            <?php }else{?>
                                <div class="w-44 text-center py-4 text-red-600 font-semibold"><?php echo "$status"; ?></div>
                            <?php } ?>
                        </div>
                    <?php
                            }
                        }else{
                    ?>
                        <p class="py-6 text-center text-gray-800 font-semibold italic">No Transporters registered</p>
                    <?php
                    
                        }
                    ?>
                </div>
            </div>
        
        </div>
        <div id="active" class="w-full rounded-md shadow-2xl overflow-hidden tabContent">
            <div class="px-10 py-6">
                <p class="font-semibold text-2xl text-gray-800">Active Transporters</p>
                <p class="text-sm text-gray-600">List of all transporters on transit.</p>
            </div>
            <div class="flex text-xs md:text-base w-full bg-gray-300 items-center justify-evenly overflow-hidden border-b font-semibold text-[15px] text-gray-800">
                <div class="w-44 text-center md:px-4 py-2">Name</div>
                <div class="w-44 text-center md:px-4 py-2">NRC No</div>
                <div class="w-44 text-center md:px-4 py-2">Phone</div>
                <div class="w-44 text-center md:px-4 py-2">Details</div>
            </div>
            <div class="overflow-auto scroll-smooth h-[350px]">
                <?php

                    // Query to get active transporters
                    $active_query = "SELECT * FROM `sas`.`Transporter` WHERE status = 'Online'";
                    $active_result = mysqli_query($conn, $active_query);
                    $num_of_rows = mysqli_num_rows($active_result);

                    if($num_of_rows){
                    
                        // Iterate through the rows 
                        while($active_row = $active_result -> fetch_assoc()){
                            $transporter_id = $active_row['transporter_id'];
                            $active_fname = $active_row['fname'];
                            $active_lname = $active_row['lname'];
                            $active_phone = $active_row['phone'];
                            $active_nrc = $active_row['nrc'];
                ?>
                        <div class="flex w-full justify-evenly border-b border-gray-200 items-center text-[12px] md:text-sm bg-white">
                            <div class="w-44 text-center md:px-4 py-4">
                                <?php echo "$active_fname $active_lname"; ?>
                            </div>
                            <div class="w-44 text-center md:px-4 py-4">
                                <?php echo "$active_nrc"; ?>
                            </div>
                            <div class="w-44 text-center md:px-4 py-4">
                                <?php echo "$active_phone"; ?>
                            </div>
                            <div class="w-44 text-center md:px-4 py-4">
                                <form action="details.php" method="get" class="">
                                    <input type="text" value="<?php  echo $transporter_id;?>" name="id" class="hidden">
                                    <button type="submit" class="text-white text-sm py-2 px-3 rounded-md bg-sky-700 text-right">View</button>
                                </form>
                            </div>
                        </div>
                <?php
                        
                    }}else{
                        echo '<p class="mt-32 py-6 text-center text-gray-800 font-semibold italic">No Active Transporters</p>';
                    }
                ?>
            </div>
        
        </div>


        
        
    </main>
    <script>
        let transporter = document.getElementById("transporter")
        transporter.classList.add("bg-sky-200")
    </script>
    <script src="../JavaScript/toggle.js"></script>
    <script src="../JavaScript/header.js"></script>
    </body>
    </html>
    
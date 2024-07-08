<?php

        // Recieve the trunk_id from gps_track.php and use it to query the database and sending a JSON

            $id = $_POST["id"];
        

            require 'conn.php';

            function sendData(){
                global $conn, $id;
                $select = "SELECT * FROM Coordinates WHERE trunk_id = '$id'";

                $result = mysqli_query($conn, $select);

                

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    $latitude = $row['latitude'];
                    $longitude = $row['longitude'];

                    $data = ["latitude" => $latitude, "longitude"=> $longitude];
                    
                    $json_data = json_encode($data);
                }else{
                    $json_data = "{}";
                }

                return $json_data;
            }

            echo sendData();

        
        
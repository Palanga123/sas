<?php

        // if (isset($_POST["id"])) {

            $id = $_POST["id"];
        

            require 'conn.php';

            function sendData(){
                global $conn, $id;
                $select = "SELECT * FROM Coordinates WHERE trunk_id = '$id'";

                $result = mysqli_query($conn, $select);

                $row = mysqli_fetch_assoc($result);

                $latitude = $row['latitude'];
                $longitude = $row['longitude'];

                if (mysqli_num_rows($result) > 0) {

                    $data = ["latitude" => $latitude, "longitude"=> $longitude];
                    
                    $json_data = json_encode($data);
                }else{
                    $json_data = "{\"latitude\": \"-12.806087840744508\", \"longitude\": \"28.239504844034045\"}";
                }

                return $json_data;
            }

            echo sendData();

        
        
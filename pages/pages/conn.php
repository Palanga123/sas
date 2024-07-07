<?php

        $username = "root";
        $password = "";
        $servername = "";
        $dbname = "sas";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn){
            die("Connection error: ".mysqli_connect_error());
        }else{
            $secure = "Connected succesfullly";        
        }

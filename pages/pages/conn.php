<?php

        $servername = "";
        $username = "root";
        $password = "";
        $dbname = "sas";

        // Connect to the database using servername, username, password and database name
        $conn = new mysqli($servername, $username, $password, $dbname);

        // If connection doesntgo through kill the connection else say connected successfully
        if ($conn -> connect_error) {
            die("Connection error: ".$conn -> connect_error);
        }else{
            $secure = "Connected succesfullly";        
        }

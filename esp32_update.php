
<?php
$servername = "";
$dBUsername = "id22339547_samson";
$dBPassword = "Samson@677";
$dBName = "id22339547_exam_db";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Read the database for fingerprint
if (isset($_POST['check_fingerprint_id'])) {
    $fingerprint_id = $_POST['check_fingerprint_id'];
    $sql = "SELECT * FROM Transporter WHERE finger_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fingerprint_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && $row['finger_id'] == $fingerprint_id) {
        echo "FINGERPRINT_MATCH";
    } else {
        echo "FINGERPRINT_DONT_MATCH";
    }
    $stmt->close();
}

// Read the database for password
if (isset($_POST['check_password'])) {
    $password = $_POST['check_password'];
    $sql = "SELECT * FROM Transporter WHERE password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && $row['password'] == $password) {
        echo "PASSWORD_MATCH";
    } else {
        echo "PASSWORD_DONT_MATCH";
    }
    $stmt->close();
}
 

// Check if the request to insert coordinates is set
if (isset($_POST['insert_coordinates'])) {
    // Log received data
    error_log("Received data: " . $_POST['insert_coordinates']);

    // Extract the coordinates string from the POST request
    $coordinates = $_POST['insert_coordinates'];

    // Split the coordinates string into latitude and longitude
    list($latitude, $longitude) = explode(',', $coordinates);
        // Prepare the SQL query to update the coordinates where id = 1
        $stmt = $conn->prepare("UPDATE Coordinates SET latitude = ?, longitude = ? WHERE trunk_id = 10");
        $stmt->bind_param("dd", $latitude, $longitude);

        // Execute the statement
        if ($stmt->execute()) {
          
            echo "Inserted";
        } else {
            echo "Error: " . $stmt->error;
            
        }

        // Close the statement
        $stmt->close();
   
} else {
   // error_log("No data received");
   // echo "No data received";
}

// light_flag insert
if (isset($_POST['insert_light_flag'])) {
    // Log received data
    error_log("Received data: " . $_POST['insert_light_flag']);

    // Extract the latitude from the POST request
    $light_level = $_POST['insert_light_flag'];

    // Prepare the SQL query to update the latitude where id = 1
    $stmt = $conn->prepare("UPDATE Alerts SET light_level = ? WHERE trunk_id = 10");
    $stmt->bind_param("d", $light_level);

    // Execute the statement
    if ($stmt->execute()) {
        // Code to execute if the update is successful (optional)
    } 

    // Close the statement
    $stmt->close();
}

// insert vibration code
if (isset($_POST['insert_vibration_flag'])) {
    // Log received data
    error_log("Received data: " . $_POST['insert_vibration_flag']);

    // Extract the latitude from the POST request
    $vibration_level = $_POST['insert_vibration_flag'];

    // Prepare the SQL query to update the latitude where id = 1
    $stmt = $conn->prepare("UPDATE Alerts SET vibration_level = ? WHERE trunk_id = 10");
    $stmt->bind_param("d", $vibration_level);

    // Execute the statement
    if ($stmt->execute()) {
        // Code to execute if the update is successful (optional)
    } 

    // Close the statement
    $stmt->close();
}
$conn->close();
?>
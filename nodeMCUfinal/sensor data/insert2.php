<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['temp']) && isset($_GET['hum']) && isset($_GET['moisture'])&& isset($_GET['ldr'])&& isset($_GET['pump_status'])&& isset($_GET['humidifier_status']) && isset($_GET['chamber_id']) ) {
 
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];
    $moisture = $_GET['moisture'];
    $ldr = $_GET['ldr'];
    $pump_status = $_GET['pumpstatus'];
    $humidifier_status = $_GET['humidifier_status'];
    $chamber_id = $_GET['chamber_id'];
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
     $con = $db->connect();
 
    // Fire SQL query to insert data in weather
    $result = mysqli_query($con,"INSERT INTO stream_chamber(`temperature`,`humidity`,`moisture`,`ldr`,`pump_status`,`humidifier_status`,`chamber_id`) VALUES('$temp','$hum','$moisture','$ldr','$pump_status','$humidifier_status','$chamber_id')");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Row successfully created.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>
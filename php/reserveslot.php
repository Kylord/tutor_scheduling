<?php

// We need to include these two files in order to work with the database
include_once('config.php');
include_once('dbutils.php');


// get a handle to the database
$db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);

$data = json_decode(file_get_contents('php://input'), true);

$isComplete = true;
$errorString = ""; 

$time_slot = $data["ts_id"];

session_start();
$user = $_SESSION['username']; 


if ($isComplete) {
    $updateQuery = "UPDATE TIME_SLOT SET IS_BOOKED = 1, STUDENT_HAWKID = '$user'
    where SESSION_NO = '$time_slot';"; 
    queryDB($updateQuery, $db); 
    $response = array();
    $response['status'] = 'success'; 
    header('Content-Type: application/json');
    echo(json_encode($response));    
}

else {

    ob_start();
    var_dump($data);
    $postdump = ob_get_clean();
    $response = array();
    $response['status'] = 'error';
    $response['message'] = $errorString . $postdump;
    header('Content-Type: application/json');
    echo(json_encode($response));    
}



?>
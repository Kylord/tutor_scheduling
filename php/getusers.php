<?php

//Files to allow working with the database
include_once('config.php');
include_once('dbutils.php');


// get a connection to the database
$db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);

$tablename = "USER_T";

// set up a query to get info on movies
$query = "SELECT * FROM $tablename;";

// run the query to get info on movies
$result = queryDB($query, $db);

// assign results to an arry we can then send back to whoever called
$users = array();
$i = 0;

// go through the results one by one
while ($currUser = nextTuple($result)) {
    $users[$i] = $currUser;
    $i++;
}

// put together a JSoN object to send back movie data
$response = array();
$response['status'] = 'success';
$response['value']['users'] = $users;
header('Content-Type: application/json');
echo(json_encode($response));

?>
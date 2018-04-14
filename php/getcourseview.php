<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start(); 
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    
    $response = array();
    $response['status'] = 'success';
    $response['name'] = 'data'; 
    header('Content-Type: application/json');
    echo(json_encode($response));
    
?>
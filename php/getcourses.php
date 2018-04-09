<?php
    include_once('config.php');
    include_once('dbutils.php');
    //get the current user from the session
    session_start(); 
    $user = $_SESSION['username'];
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    //query a users course list 
    $query = "SELECT COURSE.COURSE_FRIENDLY FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = '$user' and COURSE.COURSE_ID = ROLE_T.COURSE_ID;";
    
    $result = queryDB($query, $db);
    
    //embed the course name in a link element 
    $course_list = array();
    $i = 0; 
    while($row = nextTuple($result)){
        $course_list[$i] = $row;
        $course = $course_list[$i]['name'];
        $course_list[$i]['tag'] = "<a href =''>" . $row['COURSE_FRIENDLY'] . "</a>";  
        $i++; 
        
    }

    //send the response
    $response = array();
    $response['status'] = 'success';
    $response['user'] = $user; 
    $response['value']['courses'] = $course_list;
    header('Content-Type: application/json');
    echo(json_encode($response));
   






?>
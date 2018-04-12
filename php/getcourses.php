<?php
    include_once('config.php');
    include_once('dbutils.php');
    //get the current user 
    session_start(); 
    $user = $_SESSION['username'];
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    //query a students course list 
    $query = "SELECT COURSE.COURSE_FRIENDLY FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = '$user' and COURSE.COURSE_ID = ROLE_T.COURSE_ID
    and ROLE_T.DESCRIPTION = 'student';";
    
    //query a tutors approved list 
    $query_t = "SELECT COURSE.COURSE_FRIENDLY FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = '$user' and COURSE.COURSE_ID = ROLE_T.COURSE_ID
    and ROLE_T.DESCRIPTION = 'tutor';";
    
    $result = queryDB($query, $db);
    $result_t =  queryDB($query_t, $db);

    
    $course_list = array();
    $i = 0; 
    while($row = nextTuple($result)){
        $course_list[$i] = $row;
        $course = $course_list[$i]['name'];
        $i++;     
    }
    
    $course_list_t = array(); 
    $j = 0;
    while($row_t = nextTuple($result_t)){
        $course_list_t[$j] = $row_t;
        $course_t = $course_list_t[$j]['name'];
        $j++;     
    }
    
    
    
    //send the response
    $response = array();
    $response['status'] = 'success';
    $response['user'] = $user; 
    $response['value']['courses'] = $course_list;
    $response['value']['courses_tutor'] = $course_list_t; 
    header('Content-Type: application/json');
    echo(json_encode($response));
   






?>
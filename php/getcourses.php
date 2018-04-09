<?php
    include_once('config.php');
    include_once('dbutils.php');
    include_once('isloggedin.php');

    
    $user = $_SESSION['username'];
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    echo $user; 
    
    $query = "SELECT COURSE.DEPARTMENT FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = 'awolmutt' and COURSE.COURSE_ID = ROLE_T.COURSE_ID;";
    
    $result = queryDB($query, $db);
    
    $courses = array();
    $i = 0; 
    while ($course = nextTuple($result)){
        $courses[$i] = $course;
        $crse = $courses[$i]['depatment'];
        $c = $courses[$i]['name'];
        $courses[$i]['tag'] = "<li><a href = ''>" . $course . "</a></li>";
        $i++; 
        
    }
    
$response = array();
$response['status'] = 'success';
$response['value']['courses'] = $courses;
header('Content-Type: application/json');
echo(json_encode($response));
   






?>
<?php
    include_once('config.php');
    include_once('dbutils.php');
    //get the current user 
    session_start(); 
    $user = $_SESSION['username'];
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
    
    //query a students course list 
    $query = "SELECT COURSE.COURSE_FRIENDLY, COURSE.COURSE_ID FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = '$user' and COURSE.COURSE_ID = ROLE_T.COURSE_ID
    and ROLE_T.DESCRIPTION = 'student' and COURSE.COURSE_ID = ROLE_T.COURSE_ID;";
    
    //query a tutors approved list 
    $query_t = "SELECT COURSE.COURSE_FRIENDLY FROM COURSE, ROLE_T WHERE ROLE_T.HAWKID = '$user' and COURSE.COURSE_ID = ROLE_T.COURSE_ID
    and ROLE_T.DESCRIPTION = 'tutor';";
    
    //query the available times for a students courses
    $query_ts = "select COURSE.COURSE_ID,  USER_T.FIRST_NAME, USER_T.LAST_NAME, USER_T.EMAIL, TIME_SLOT.DATE_TIME,
    TIME_SLOT.COURSE_ID, TIME_SLOT.SESSION_NO
    from USER_T, TIME_SLOT, COURSE, ROLE_T 
    where USER_T.HAWKID = TIME_SLOT.HAWKID and ROLE_T.HAWKID = 'awolmutt' and
    COURSE.COURSE_ID = ROLE_T.COURSE_ID and TIME_SLOT.COURSE_ID = ROLE_T.COURSE_ID and
    TIME_SLOT.IS_BOOKED = 0 and ROLE_T.DESCRIPTION = 'student';";
    
    $query_sess = "select COURSE.COURSE_FRIENDLY, TIME_SLOT.DATE_TIME, USER_T.FIRST_NAME,
    USER_T.LAST_NAME, USER_T.EMAIL
    from USER_T, TIME_SLOT, COURSE
    where COURSE.COURSE_ID = TIME_SLOT.COURSE_ID and TIME_SLOT.STUDENT_HAWKID= '$user'
    and USER_T.HAWKID = TIME_SLOT.HAWKID;";
    
    
    $result = queryDB($query, $db);
    $result_t =  queryDB($query_t, $db);
    $result_ts = queryDB($query_ts, $db);
    $result_sess = queryDB($query_sess, $db); 

    
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
    
    $times_list = array();
    $k = 0; 
    while($row_k = nextTuple($result_ts)){
        $times_list[$k] = $row_k;
        $times_ = $times_list[$k]['name'];
        $k++; 
    }
    
    $current_sessions = array();
    $n = 0;
    while($row_n = nextTuple($result_sess)){
        $current_sessions[$n] = $row_n;
        $sess_ = $times_list[$n]['name'];
        $n++; 
    }
    
    
    
    
    //send the response
    $response = array();
    $response['status'] = 'success';
     
    for($l = 0; $l < count($course_list); $l++) {
        $response['value'][$l] = $course_list[$l];
        for($m = 0; $m < count($times_list); $m++) {
            if ($response['value'][$l]['COURSE_ID'] != $times_list[$m]['COURSE_ID']){
                
            }
            else{
                $response['value'][$l]['times'][$m] = $times_list[$m]; 
            }
        }
    }
    $response['user'] = $user;
    $response['current_sessions'] = $current_sessions; 
    header('Content-Type: application/json');
    echo(json_encode($response));
   






?>
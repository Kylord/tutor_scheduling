<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    // get data from form
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
	$password = $data['password'];
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    // check if username meets criteria
    if (!isset($username) || (strlen($username) < 2)) {
        $isComplete = false;
        $errorMessage .= "Please enter a username with at least two characters. ";
    } else {
        $username = makeStringSafe($db, $username);
    }
    
    if (!isset($password) || (strlen($password) < 4)) {
        $isComplete = false;
        $errorMessage .= "Please enter a password with at least four characters. ";
    }      
	
    if ($isComplete) {   
    
        // get the hashed password from the user with the email that got entered
        $query = "SELECT HAWKID, HASHED_PSSWRD FROM USER_T WHERE HAWKID='$username';";
        $result = queryDB($query, $db);
        
        
        if (nTuples($result) == 0) {
            // no such username
            $errorMessage .= " Username $username does not correspond to any account in the system. ";
            $isComplete = false;
        }
    }
    if ($isComplete){
        $permission_query =  "SELECT * FROM ROLE_T WHERE HAWKID = '$username';";
        $result_p = queryDB($permission_query, $db);

        
        if (nTuples($result_p) == 0){
            $errorMessage .= "Could not find user role in the system";
            $isComplete = false; 
        }
    }
    
    
    if ($isComplete) {            
        // there is an account that corresponds to the email that the user entered
		// get the hashed password for that account
		$row = nextTuple($result);
		$hashedpass = $row['HASHED_PSSWRD'];
		$id = $row['HAWKID'];
		
        if ($hashedpass != $password) {
            // if password is incorrect
            $errorMessage .= " The password you enterered is incorrect. ";
            $isComplete = false;
        }
    }
    
    if ($isComplete){
        $permission_row = nextTuple($result_p);
        $permission = $permission_row['DESCRIPTION'];
        
        
    }
    
    
         
    if ($isComplete) {   
        // password was entered correctl
        // start a session
        // if the session variable 'username' is set, then we assume that the user is logged in
        session_start();
        $_SESSION['username'] = $username;
		$_SESSION['accountid'] = $id;
        $response = array();
        $response['status'] = 'success';
		$response['message'] = 'logged in';
        $response['permission'] = $permission;  
        header('Content-Type: application/json');
        echo(json_encode($response));
    } else {

        ob_start();
        var_dump($data);
        $postdump = ob_get_clean();

        $response = array();
        $response['status'] = 'error';
        $response['message'] = $errorMessage . $postdump;
        header('Content-Type: application/json');
        echo(json_encode($response));          
    }

?>
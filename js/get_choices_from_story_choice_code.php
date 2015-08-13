<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$now = Carbon::now('Indian/Maldives')->toDateTimeString();

	//http://stackoverflow.com/questions/18382740/cors-not-working-php
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }


    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$code = $request->code;
		$dir = 'sqlite:stories.sqlite';
 		$dbh = new PDO($dir) or die("cannot open database");
 		$query = "SELECT * FROM choices WHERE parent='$code'";
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"choice_text" => $row['choice_text'],
     		"choice_code" => $row['choice_code']);   
		}
		echo json_encode($myArray);
/*		if ($code != "") {

 	
 	

$count = $dbh->exec("INSERT INTO logs(user_details,message,created_at,updated_at,status) VALUES('$user_details','$message','$now','$now','$status')")or die(print_r($dbh->errorInfo(), true));; 

/* Return number of rows that were deleted */





			//echo "Successfully sent " . $user_details . $message .$now; 
//echo $code;
		}
		/*
		else {
			echo "Empty username parameter!";
		}
	}
	else {
		echo "Not called properly with username parameter!";
	}*/
?>
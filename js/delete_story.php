<?php


    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_code = $request->choice_code;
		
		$dir = 'sqlite:stories.sqlite';
 		$dbh = new PDO($dir) or die("cannot open database");
 		//$query = "SELECT * FROM story WHERE code='$code'";
 		$delete_story = $dbh->exec("DELETE FROM story WHERE code='$choice_code'")or die(print_r($dbh->errorInfo(), true));
 		$delete_choice = $dbh->exec("DELETE FROM choices WHERE choice_code='$choice_code'")or die(print_r($dbh->errorInfo(), true));

 		
 		/*
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"story" => $row['story'],
     		"code" => $row['code']);   
		}
		echo json_encode($myArray);*/
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
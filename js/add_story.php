<?php


    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$parent = $request->parent;
		$choice_text=$request->choice_text;
		$story=$request->story;

		echo $choice_text;
		echo $parent;
		echo $story;
		
		$dir = 'sqlite:stories.sqlite';
 		$dbh = new PDO($dir) or die("cannot open database");
 		//$query = "SELECT * FROM story WHERE code='$code'";
 		$add_story = $dbh->exec("INSERT INTO story(story) VALUES('$story')")or die(print_r($dbh->errorInfo(), true));
 		$query ="SELECT code FROM story ORDER BY code DESC LIMIT '1'";
 		$myArray = array();
		foreach ($dbh->query($query) as $row) {
				$myArray[] = array(
		    	"code" => $row['code'],
				);   
		}

 		$new_code = $myArray[0]['code'];

 		$add_choice = $dbh->exec("INSERT INTO choices(choice_text,choice_code,parent) VALUES('$choice_text','$new_code','$parent')")or die(print_r($dbh->errorInfo(), true));

 	

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
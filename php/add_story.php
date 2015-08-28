<?php
	require("config.php");
	require ("global_functions.php");




   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$parent = $request->parent;
		$choice_text=$request->choice_text;
		$story=$request->story;

		//$banana=mysqli_real_escape_string($story);

		//echo $choice_text;
		//echo $parent;
		//echo $banana;
 		//$add_query = "INSERT INTO story(story) VALUES('$banana')";

 	/*	$adds_query = sprintf("INSERT INTO story(story) VALUES(%s)",
	           quote($story));

		/*$sql = $dbh->prepare("INSERT INTO story (story) VALUES (:story");
		$dbh->exec(array(":story" => $story))or die(print_r($dbh->errorInfo(), true));*/

		$insert_story = "INSERT INTO story(story) VALUES(:story)";
		$sth   = $dbh->prepare($insert_story);
		$sth->execute(array(':story' => $story) );	



/*

 		$add_story = $dbh->exec($adds_query)or die(print_r($dbh->errorInfo(), true));*/

 		$query ="SELECT code FROM story ORDER BY code DESC LIMIT '1'";
 		$myArray = array();
		foreach ($dbh->query($query) as $row) {
				$myArray[] = array(
		    	"code" => $row['code'],
				);   
		}

 		$new_code = $myArray[0]['code'];

 		//echo $new_code;

 		$queryz = "INSERT INTO choices(choice_text,choice_code,parent) VALUES(:choice_text,:new_code,:parent)";
		$sth   = $dbh->prepare($queryz);
		$sth->execute(array(':choice_text' => $choice_text,':new_code'=>$new_code,':parent'=>$parent) );

		        echo json_encode(DisplayMessage("0", "Story Added Successfully"));
	

/*
 		$add_choice = $dbh->exec("INSERT INTO choices(choice_text,choice_code,parent) VALUES('$choice_text','$new_code','$parent')")or die(print_r($dbh->errorInfo(), true));*/
		}



?>
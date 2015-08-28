<?php
	require("config.php");
	require ("global_functions.php");


    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_code = $request->choice_code;
		$choice_text=$request->choice_text;
		$story=$request->story;

		//echo $choice_text;
		//echo $choice_code;
		//echo $story;
	
	 	/*	$update_choice = $dbh->exec("UPDATE choices SET choice_text='$choice_text' WHERE choice_code='$choice_code'")or die(print_r($dbh->errorInfo(), true)); */


	 		$update_choice = "UPDATE choices SET choice_text=:choice_text WHERE choice_code=:choice_code";
		$sth   = $dbh->prepare($update_choice);
		$sth->execute(array(':choice_text' => $choice_text,':choice_code'=> $choice_code) );	


/*
 		$update_story = $dbh->exec("UPDATE story SET story='$story' WHERE code='$choice_code'")or die(print_r($dbh->errorInfo(), true));*/


 		$query = "UPDATE story SET story=:story WHERE code=:choice_code";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':story' => $story,':choice_code'=> $choice_code) );

		        echo json_encode(DisplayMessage("0", "Updated Story Successfully"));
	
 	
		}

?>
<?php
	require("config.php");
		require("global_functions.php");


    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_code = $request->choice_code;

		if($choice_code=='45'){}else{

		$query = "DELETE FROM story WHERE code=:choice_code";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':choice_code' => $choice_code) );	
		
 		/*$delete_story = $dbh->exec("DELETE FROM story WHERE code='$choice_code'")or die(print_r($dbh->errorInfo(), true));*/

 		$query = "DELETE FROM choices WHERE choice_code=:choice_code";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':choice_code' => $choice_code) );

				 echo json_encode(DisplayMessage("0", "Story deleted successfully!"));        


		/*
 		$delete_choice = $dbh->exec("DELETE FROM choices WHERE choice_code='$choice_code'")or die(print_r($dbh->errorInfo(), true));*/

		}
	}

?>
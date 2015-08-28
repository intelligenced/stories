<?php
	require("config.php");
	require("global_functions.php");

    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_id = $request->choice_id;

		//echo $choice_id;


		$query = "DELETE FROM choices WHERE id=:choice_id";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':choice_id' => $choice_id) )or die(print_r($dbh->errorInfo(), true));
		 echo json_encode(DisplayMessage("0", "Redirect deleted successfully!"));        
		


	

		
	}

?>
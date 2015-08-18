<?php
	require("config.php");

    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_code = $request->choice_code;

		if($choice_code=='45'){}else{
		
 		$delete_story = $dbh->exec("DELETE FROM story WHERE code='$choice_code'")or die(print_r($dbh->errorInfo(), true));
 		$delete_choice = $dbh->exec("DELETE FROM choices WHERE choice_code='$choice_code'")or die(print_r($dbh->errorInfo(), true));

		}
	}

?>
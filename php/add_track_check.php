<?php
	require("config.php");



   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$track_id = $request->track_id;
		$choice_id = $request->choice_id; 
	
		echo $track_id;
		echo $choice_id;

		if($choice_id==""){}else{


		$update_choice = "UPDATE choices SET check_track=:track_id WHERE id=:choice_id";
		$sth   = $dbh->prepare($update_choice);
		$sth->execute(array(':track_id' => $track_id,':choice_id'=> $choice_id) )
			or die(print_r($sth->errorInfo(), true));
		


			}

		}



?>
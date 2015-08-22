<?php
	require("config.php");

    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$track_id = $request->track_id;

		echo $track_id;

		


		$query = "DELETE FROM choices WHERE add_track=:track_id";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':track_id' => $track_id) );	


		$query = "DELETE FROM choices WHERE check_track=:track_id";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':track_id' => $track_id) );	


		$query = "DELETE FROM tracks WHERE track_id=:track_id";
		$sth   = $dbh->prepare($query);
		$sth->execute(array(':track_id' => $track_id) );	

	

		
	}

?>
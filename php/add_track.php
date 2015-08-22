<?php
	require("config.php");

/*

   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$track_name = $request->track_name; */
		 $track_name ="orange";
		

	$sth= $dbh->prepare("INSERT INTO tracks(track_name) VALUES(:track_name)");

		$sth->execute(array(':track_name' => $track_name)) or die(print_r($sth->errorInfo(), true));

		//var_dump($sth->execute(array(':track_name' => $track_name)));

		//s}



?>
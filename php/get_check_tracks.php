<?php
require("config.php");

 $query = "SELECT * FROM choices INNER JOIN tracks ON  choices.check_track=tracks.track_id
 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"track_id" => $row['track_id'],
    	"track_name"=>$row['track_name'],
    	"choice_text"=>$row['choice_text']
		);   
}

echo json_encode($myArray);

?>
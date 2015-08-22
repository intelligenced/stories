<?php
require("config.php");

 $query = "SELECT * FROM tracks ORDER BY track_id DESC
 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"track_id" => $row['track_id'],
    	"track_name"=>$row['track_name']
		);   
}

echo json_encode($myArray);

?>
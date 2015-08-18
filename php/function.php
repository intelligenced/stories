<?php
require("config.php");
 $query = "SELECT * FROM story
 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"code" => $row['code'],
     	"story" => $row['story']

		);   
}

echo json_encode($myArray);

?>
<?php

require("config.php");

 		$query = "SELECT * FROM choices WHERE redirect=1";
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"choice_text" => $row['choice_text'],
     		"choice_code" => $row['choice_code'],
     		"choice_id"=> $row['id']);   
		}
		echo json_encode($myArray);

	

?>
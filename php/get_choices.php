<?php
require("config.php");

 $query = "SELECT * FROM choices ORDER BY choice_code DESC
 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"choice_text" => $row['choice_text'],
    	"choice_code"=>$row['choice_code'],
     	"choice_parent" => $row['parent']

		);   
}

echo json_encode($myArray);

?>
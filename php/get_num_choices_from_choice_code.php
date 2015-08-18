<?php
require("config.php");

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
			$code = $request->code;		


	//$code = "23";		
 		$query = "SELECT * FROM choices WHERE parent='$code'";
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"choice_text" => $row['choice_text'],
     		"choice_code" => $row['choice_code'],
     		"parent"=> $row['parent']
     		);   
		}
		echo json_encode($myArray);

?>
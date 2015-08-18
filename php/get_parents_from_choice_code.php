<?php
require("config.php");

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
			$code = $request->code;		


	//$code = "23";		

 		$query = "SELECT * FROM choices WHERE choice_code='$code'";
		$temp = array();
 		foreach ($dbh->query($query) as $row) {
			$temp[] = array(
    		"choice_text" => $row['choice_text'],
     		"choice_code" => $row['choice_code'],
     		"parent"=> $row['parent']
     		);   
		}
		$parent = $temp[0]['parent'];

		$query = "SELECT * FROM choices WHERE choice_code='$parent'";
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
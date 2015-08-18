<?php

require("config.php");

    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$code = $request->code;
 		$query = "SELECT * FROM story WHERE code='$code'";
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"story" => $row['story'],
     		"code" => $row['code']);   
		}
		echo json_encode($myArray);

		}

?>
<?php
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$code = $request->code;
		$dir = 'sqlite:stories.sqlite';
 		$dbh = new PDO($dir) or die("cannot open database");
 		$query = "SELECT * FROM choices WHERE parent='$code'";
		$myArray = array();
 		foreach ($dbh->query($query) as $row) {
			$myArray[] = array(
    		"choice_text" => $row['choice_text'],
     		"choice_code" => $row['choice_code']);   
		}
		echo json_encode($myArray);

?>
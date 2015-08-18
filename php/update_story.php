<?php
	require("config.php");


    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$choice_code = $request->choice_code;
		$choice_text=$request->choice_text;
		$story=$request->story;

		echo $choice_text;
		echo $choice_code;
		echo $story;
	
	 		$update_choice = $dbh->exec("UPDATE choices SET choice_text='$choice_text' WHERE choice_code='$choice_code'")or die(print_r($dbh->errorInfo(), true));

 		$update_story = $dbh->exec("UPDATE story SET story='$story' WHERE code='$choice_code'")or die(print_r($dbh->errorInfo(), true));
 	
		}

?>
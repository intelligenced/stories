<?php
	require("config.php");
   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$parent = $request->parent;
		$choice_text=$request->choice_text;
		$story=$request->story;

		echo $choice_text;
		echo $parent;
		echo $story;

 		//$query = "SELECT * FROM story WHERE code='$code'";
 		$add_story = $dbh->exec("INSERT INTO story(story) VALUES('$story')")or die(print_r($dbh->errorInfo(), true));
 		$query ="SELECT code FROM story ORDER BY code DESC LIMIT '1'";
 		$myArray = array();
		foreach ($dbh->query($query) as $row) {
				$myArray[] = array(
		    	"code" => $row['code'],
				);   
		}

 		$new_code = $myArray[0]['code'];

 		$add_choice = $dbh->exec("INSERT INTO choices(choice_text,choice_code,parent) VALUES('$choice_text','$new_code','$parent')")or die(print_r($dbh->errorInfo(), true));

		}

?>
<?php
	require("config.php");



   $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);

		$parent = $request->parent;
		$choice_text=$request->choice_text;
		$choice_code=$request->choice_code;


		if($choice_code==$parent){
			echo $message= "This does not make sense...at all";
		}else if($choice_code=="" || $parent=="" || $choice_text==""){ echo $message= "type something,damn it";}else{

		echo $choice_text;
		echo $parent;
	
 		$queryz = "INSERT INTO choices(choice_text,choice_code,parent,redirect) VALUES(:choice_text,:choice_code,:parent,1)";
		$sth   = $dbh->prepare($queryz);
		$sth->execute(array(':choice_text' => $choice_text,':choice_code'=>$choice_code,':parent'=>$parent) )or die(print_r($dbh->errorInfo(), true));	

/*
 		$add_choice = $dbh->exec("INSERT INTO choices(choice_text,choice_code,parent) VALUES('$choice_text','$new_code','$parent')")or die(print_r($dbh->errorInfo(), true));*/
		}

		}



?>
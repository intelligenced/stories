

<?php
function DisplayMessage($type,$message){


//alert-success
//alert-info
//alert-warning
//alert-danger
	$myArray = array();

	if($type=="0"){
		$alerttype="alert-success";
	}else if($type=="1"){
		$alerttype="alert-warning";
	}else{
		$alerttype="alert-danger";
	}

	$myArray[] = array("alerttype" => $alerttype,"message" => $message);
	return $myArray;



}

?>
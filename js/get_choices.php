<?php
header('Content-Type: application/json');
/*
	$myArray = array();


  $myPDO = new PDO('sqlite:database.sqlite');
   $query = $myPDO->query("SELECT * FROM users");

foreach ($myPDO->query($query) as $row) {
echo json_encode($row[0]);
}
//

//var_dump($result);

 INNER JOIN logs ON users.number=logs.user_details INNER JOIN types ON users.id=types.type_id


*/

 
 
$dir = 'sqlite:stories.sqlite';
 $dbh = new PDO($dir) or die("cannot open database");
 $query = "SELECT * FROM choices
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
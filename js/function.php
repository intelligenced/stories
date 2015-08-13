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
 $query = "SELECT * FROM story
 ";


	$myArray = array();
 
foreach ($dbh->query($query) as $row) {

		$myArray[] = array(
    	"code" => $row['code'],
     	"story" => $row['story']

		);   
}

echo json_encode($myArray);

?>
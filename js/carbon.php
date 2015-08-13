<?php
require 'vendor/autoload.php';

use Carbon\Carbon;


 $dt= Carbon::now();
$dt->timezone = new DateTimeZone('Indian/Maldives');
$dt->timezone = 'Indian/Maldives';
$dt->tz = 'Indian/Maldives';

$banana ="2015-08-02 16:00:40";
$default_time = Carbon::now();

 
    $carbontime= Carbon::createFromFormat('Y-m-d H:i:s',$banana,'Indian/Maldives');





$test = $carbontime->diffForHumans();

echo " the default time of carbon <br> ".$default_time."<br><br>";

echo " the given time <br> ".$banana."<br><br>";

echo " the given time converted to carbon time  <br> ".$carbontime."<br><br>";

echo " the test <br> ".$test."<br><br>";



echo $dt;




?>
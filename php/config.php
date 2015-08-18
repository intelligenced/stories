<?php

//DB PDO Connection
  
  $dir = 'sqlite:../storage/stories.sqlite';
  $dbh = new PDO($dir) or die("cannot open database");

?>
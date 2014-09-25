<?php
$file = fopen("users.csv","r");

while(! feof($file))
  {
  print_r(fgetcsv($file));
  }

fclose($file);

?>
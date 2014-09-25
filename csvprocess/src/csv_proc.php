<?php
require ('mysql_proc.php');
$dao = new MysqlProc();

$file = fopen("users.csv","r");

while(! feof($file))
{
	$arr = fgetcsv($file);
	if($arr[0]!="")
		$dao->addUser($arr[0],$arr[1],$arr[2]);
}

fclose($file);

?>
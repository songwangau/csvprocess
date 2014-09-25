<?php
require ('mysql_proc.php');
$dao = new MysqlProc();

$file = fopen("users.csv","r");

while(! feof($file))
{
	$arr = fgetcsv($file);
	$dao->addUser(capfirst($arr[0]),capfirst($arr[1]),emailValidate($arr[2]));
}

fclose($file);

function capfirst($bar){
	return ucfirst(strtolower(trim($bar)));
}

function emailValidate($email){
	$email = trim($email);
	if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) {
		$email = strtolower($email);
	} else {
		$email="";
		error_log("You messed up!", 3, "my-errors.log");
	}
	return $email;
}
?>
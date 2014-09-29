<?php
require ('mysql_proc.php');
$dao = new MysqlProc();
$file = fopen("users.csv","r");
fgetcsv($file);
while(! feof($file))
{
	$arr = fgetcsv($file);
	if(isset($arr[0]) && $arr[0]!=""){
		$dao->addUser(capfirst($arr[0]),capfirst($arr[1]),emailValidate($arr[2]));
	}
}

fclose($file);

function capfirst($bar){
	return ucfirst(strtolower(filterstr($bar)));
}

function filterstr($str){
	$replace = array(')','=','+','$','-','、','、','：',';','！','!','/');
	return trim(str_replace($replace, '', $str));
}

function emailValidate($email){
	$email = trim($email);
	if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) {
		$email = strtolower($email);
	} else {
		error_log("The email address ".$email." is invalid.\n", 3, "my-errors.log");
		$fs = fopen('php://stdout', 'w');
		fputs($fs, "The email address ".$email." is invalid.\n");
		fclose($fs);
		$email="";
	}
	return $email;
}
?>
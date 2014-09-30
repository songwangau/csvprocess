<?php
/**
 * ProcessCSV class
 * csv processing class
 * @author songwang
 *
 */
class ProcessCSV{

	/**
	 * processing CSV file, and then save data into DB
	 *
	 * @param string $filePath
	 */
	function run($username, $password,$server="localhost",$filePath="./app/res/users.csv"){
		if(file_exists($filePath)) {
			$dao = new MysqlProc($server, $username, $password);
			$file = fopen($filePath,"r");
			fgetcsv($file);
			while(! feof($file))
			{
				$arr = fgetcsv($file);
				if(isset($arr[0]) && $arr[0]!=""){
					$dao->addUser($this->capfirst($arr[0]),$this->capfirst($arr[1]),$this->emailValidate($arr[2]));
				}
			}
			fclose($file);
		}
		else {
			echo "CSV file Not Found.\n";
			exit;
		}
	}

	/**
	 * processing CSV file, and then save data into DB
	 *
	 * @param string $filePath
	 */
	function dryRun($filePath="./app/res/users.csv"){
		if(file_exists($filePath)) {
			$dao = new MysqlProc($server, $username, $password, $database);
			$file = fopen($filePath,"r");
			fgetcsv($file);
			while(! feof($file))
			{
				$arr = fgetcsv($file);
				if(isset($arr[0]) && $arr[0]!=""){
					$this->emailValidate($arr[2]);
				}
			}
			fclose($file);
		}
		else {
			echo "CSV file Not Found.\n";
			exit;
		}
	}
	
	/**
	 * processing username string about make string to lower and make a string's first character uppercase
	 *
	 * @param String $bar
	 */
	function capfirst($str){
		return ucfirst(strtolower($this->filterstr($str)));
	}

	/**
	 * processing username string about filter ')','=','+','$','-','、','、','：',';','！','!','/'
	 *
	 * @param String $str
	 */
	function filterstr($str){
		$replace = array(')','=','+','$','-','、','、','：',';','！','!','/');
		return trim(str_replace($replace, '', $str));
	}

	/**
	 * processing email address string
	 *
	 * @param string $email
	 */
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

}
?>
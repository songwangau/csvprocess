<?php
require_once './app/configure.php';
/**
 * Mysql Proc
 * mysql operation class
 * @author songwang
 *
 */
class MysqlProc{

	/**
	 * construct method for create DB connect
	 *
	 * @param string $server
	 * @param string $username
	 * @param string $password
	 * @param string $database
	 */
	function __construct($server, $username, $password, $database=DB_DATABASE, $mysqli_conn = 'db_link') {
		global $$mysqli_conn;
		$$mysqli_conn = new mysqli($server, $username, $password, $database);
		if ( $$mysqli_conn->errno) die("Error opening database: " .  $$mysqli_conn->error());
	}

	/**
	 * create user table into DB
	 *
	 * @param string $filePath
	 * @param string $mysqli_conn
	 */
	public function createUserTable($filePath = SQL_FILE, $mysqli_conn = 'db_link') {
		global $$mysqli_conn;
		if(file_exists($filePath)) {
			$handle = fopen($filePath, "r");
			$sql_str = fread($handle, filesize($filePath));
			fclose($handle);
			if(!empty($sql_str)) {
				if ($$mysqli_conn->query($sql_str)===TRUE) {
					printf("User table was created successfully.\n", $result->num_rows);
					$result->close();
				}else{
					printf("Failed to create user table.\n", $result->num_rows);
				}
				$$mysqli_conn->close();
			}
		}
		else {
			echo "SQL file Not Found.\n";
		}
	}

	/**
	 * add user into DB
	 *
	 * @param string $user_name
	 * @param string $surname
	 * @param string $email
	 */
	public function addUser($user_name, $surname, $email, $mysqli_conn = 'db_link') {
		global $$mysqli_conn;
		$sql_str = "INSERT INTO users (user_name, surname, email, status, create_date) VALUES (?,?,?,1,now())";
		if ($stmt = $$mysqli_conn->prepare($sql_str)) {
			$stmt->bind_param("sss", $user_name, $surname, $email);
			$stmt->execute();
		}
	}
}
?>
<?php

require ('configure.php');

class MysqlProc{

	function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE) {
		$mysqli = new mysqli("localhost", "root", "root","csv_p_db");
		if ($mysqli->errno) die("Error opening database: " . $database->error());
		return $mysqli;
	}

	public function addUser($user_name, $surname, $email) {
		$mysqli=$this->db_connect();
		$sql_str = "INSERT INTO users (user_name, surname, email, status, create_date) VALUES (?,?,?,1,now())";
		if ($stmt = $mysqli->prepare($sql_str)) {
			$stmt->bind_param("sss", $user_name, $surname, $email);
			$stmt->execute();
		}
	}
}
?>
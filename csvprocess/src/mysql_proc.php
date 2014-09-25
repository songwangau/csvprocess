<?php

require ('configure.php');

class MysqlProc{

	function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {

		global $$link;

		$$link = mysql_connect($server, $username, $password);

		if ($$link) { mysql_select_db($database); }

		return $$link;

	}


	function tep_db_query($query, $link = 'db_link') {

		global $$link;

		if ((isset($_GET['logsql']))&&(DEPLOYMENT=='test')) {

			error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);

			$result = mysql_query($query, $$link) or tep_db_error($query, mysql_errno(), mysql_error());

			$result_error = mysql_error();

			error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);

			error_log('MEMORY USAGE emalloc() ' . memory_get_usage() . "&nbsp;&nbsp;SYSTEM ALLOC ".memory_get_usage(TRUE)."\n", 3, STORE_PAGE_PARSE_TIME_LOG);

			return $result;

		}
		$result = mysql_query($query, $$link) or tep_db_error($query, mysql_errno(), mysql_error());

		return $result;

	}


	public function getConnection() {
		$this->db_connect() ;
	}

	public function addUser($user_name, $surname, $email) {
		$this->getConnection();


		$sql_str = "INSERT INTO users (user_name, surname, email) VALUES ('".$user_name."','".$surname."','".$email."')";

		$this->tep_db_query($sql_str);
	}

}
?>
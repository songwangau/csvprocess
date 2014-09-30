<?php
/**
 * Main function for improve data to mysql by CSV file
 * 
 * @author Song Wang 
 * @version 1.0
 */

require_once './app/process_csv.php';
require_once './app/mysql_proc.php';
require_once './app/configure.php';
require_once './app/helper.php';

$shortopts  = "";
$shortopts .= "u:";  // Required value
$shortopts .= "p:"; // Required value
$shortopts .= "h:"; //  Required value

$longopts  = array(
    "file:",     // Required value
    "create_table",    //  Required value
    "dry_run",      // optional
    "help"           // optional
);
$options = getopt($shortopts, $longopts);
//php main.php --create_table -u root -p root -h localhost
if(isset($options["create_table"])){
	$dao = new MysqlProc($options["h"], $options["u"], $options["p"]);
	$dao->createUserTable();
	exit;
}else if(isset($options["dry_run"])){//php main.php --dry_run --file ./users.csv
	$prcess_csv = new ProcessCSV();
	$prcess_csv->dryRun($options["file"]);
	exit;
}else if(isset($options["file"])){//php main.php --file ./users.csv -u root -p root -h localhost
	$prcess_csv = new ProcessCSV();
	$prcess_csv->run($options["u"],$options["p"],$options["h"],$options["file"]);
	exit;
}else{
	helper();
	exit;
}
?>
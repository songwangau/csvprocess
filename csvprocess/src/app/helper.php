<?php

/**
 * Print help information
 * 
 * @param string $filePath
 */
function helper($filePath=HELP_FILE){
	if(file_exists($filePath)) {
		$handle = fopen($filePath, "r");
		$fileContents = fread($handle, filesize($filePath));
		fclose($handle);
		if(!empty($fileContents)) {
			echo $fileContents."\n";
		}
	}
	else {
		echo "File Not Found.";
	}
}
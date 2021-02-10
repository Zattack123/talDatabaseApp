<?php
//FILE: install.php
//Zach Dilliha, WKU 2020
//CS 351

require "config.php";

//this query checks if the database named 'tal' exists
$sql = "SELECT SCHEMA_NAME
  FROM INFORMATION_SCHEMA.SCHEMATA
 WHERE SCHEMA_NAME = 'tal'";

//if tal does not exist, take the tal.sql file and import it
if (!mysqli_query($conn, $sql)) {

	$query = '';
	$sqlScript = file('sql/tal.sql');
	foreach ($sqlScript as $line)	{

		$startWith = substr(trim($line), 0 ,2);
		$endWith = substr(trim($line), -1 ,1);
		if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			continue;
		}
		$query = $query . $line;
		if ($endWith == ';') {
			mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
			$query= '';
		}
	}
	echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
	header("Location:php/index.php");
}
//if tal does exist, then skip intallation and go straight to the app
else{
	header("Location:php/index.php");
}
?>

<?php
	$db_host = "DB_HOST";
	$db_username = "DB_USER";
	$db_pass = "DB_PASSWORD";
	$db_name = "DB_NAME";

	($GLOBALS["___mysqli_ston"] = mysqli_connect($db_host,  $db_username,  $db_pass, $db_name, 3307)) or die ("Could not connect connect to MySQL Server");
	((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE $db_name")) or die ("No database");
	mysqli_set_charset($GLOBALS["___mysqli_ston"], 'utf8');
?>

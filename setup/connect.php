<?php

/**
* Server and Database Connection
*/

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "diagnose";
$conn_error = "Connection Not Successful";

$link = @mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);

class DatabaseException extends Exception{}

try{
	if (!$link) {
		throw new Exception("Could not connect to Server/Database."); 
	} else {
		
	}
}
catch(Exception $err){
	echo "Error: ". $err->getMessage();
}

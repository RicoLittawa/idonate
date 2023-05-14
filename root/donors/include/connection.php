<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="u321569821_idonate";
try{

	$conn=mysqli_connect($server_name,$username,$password,$database_name);
	if(!$conn){
		throw new Exception(mysqli_connect_error());
	}

	
}
catch(Exception $e){
	echo "SQL error";
}
<?php
$serverName= "DESKTOP-S2EIV7U";
$ConnectionOptions=[
	"Database"=>"DemoDB",
	"UID"=>"",
	"PWD"=>""
];
$conn = sqlsrv_connect($serverName, $ConnectionOptions);
if($conn == false)
	die(print_r(sqlsvr_errors(),true));
	else echo 'Connection Success';

?>

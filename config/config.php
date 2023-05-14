<?php
define('SMTP_USERNAME', 'testcdrrmo@gmail.com');
define('SMTP_PASSWORD', 'mlytxekfgplnhsap');
define('DB_USERNAME', 'u321569821_idonate');
define('DB_PASSWORD', 'Idonate123');

$server_name="localhost";
$username="root";
$password="";
$database_name=DB_USERNAME;

try {
    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    if(!$conn) {
        throw new Exception(mysqli_connect_error());
    }
} catch(Exception $e) {
    echo "SQL error";
}


?>
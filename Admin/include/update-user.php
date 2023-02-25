<?php 
require_once 'connection.php';
if (isset($_GET['updateUser'])){
    $uID = $_GET["updateUser"];
    echo $uID;
}

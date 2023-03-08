<?php
session_start();

if (isset($_SESSION['user'])) {
    $userID = $_SESSION['user']['uID'];
    $loggin= $_SESSION['user']['logged_in'];
} 
// else {
//     // User is not logged in, redirect to login page
//     header("Location: login.php?Loginfirst");
//     exit();
// }
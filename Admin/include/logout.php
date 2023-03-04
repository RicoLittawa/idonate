<?php 
    include 'protect.php';
    require_once 'connection.php';

    $status = 'offline';
    $updateStatus = "UPDATE adduser SET status = ? WHERE uID = ?";
    $stmt = $conn->prepare($updateStatus);
    $stmt->bind_param('si', $status, $userID);
    $stmt->execute();

    unset($_SESSION['users']);
    session_destroy();

    header("location: ../login.php?logged_out");
    exit();



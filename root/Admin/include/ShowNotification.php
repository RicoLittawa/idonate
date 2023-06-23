<?php 
require_once "../../../config/config.php";
if (isset($_GET["userID"])){
    $userID = $_GET["userID"];
    $getNotifCount = $conn->prepare("SELECT COUNT(*) AS notificationCount FROM notification WHERE userID = ?");
    $getNotifCount->bind_param("i", $userID);
    $getNotifCount->execute();
    $notifCountResult = $getNotifCount->get_result();
    $notifCountRow = $notifCountResult->fetch_assoc();
    $notificationCount = $notifCountRow["notificationCount"];
    echo $notificationCount;
}
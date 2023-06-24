<?php
require_once "../../../config/config.php";

// Retrieve the number of rows from the admin_notification table
$getAdminNotification = $conn->prepare("SELECT COUNT(*) as count FROM admin_notification");
$getAdminNotification->execute();
$result = $getAdminNotification->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];
$response = array(
    'count' => $count
);
header('Content-Type: application/json');
echo json_encode($response);
exit();

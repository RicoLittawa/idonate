<?php
require_once "../../../config/config.php";

// Retrieve the number of rows from the admin_notification table
$getAdminNotification = $conn->prepare("SELECT COUNT(*) as count FROM admin_notification");
$getAdminNotification->execute();
$result = $getAdminNotification->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];

// Prepare the response data
$response = array(
    'count' => $count
);

// Set the response headers to indicate JSON content
header('Content-Type: application/json');

// Return the response as a JSON string
echo json_encode($response);
exit();

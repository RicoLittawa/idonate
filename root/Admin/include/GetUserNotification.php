<?php
require_once "../../../config/config.php";

if (isset($_GET["userID"])) {
    $userID = $_GET["userID"];
    $getUserNotification = $conn->prepare("SELECT COUNT(*) as count FROM notification WHERE userID = ?");
    $getUserNotification->bind_param("i", $userID);
    $getUserNotification->execute();
    $result = $getUserNotification->get_result();

    try {
        if ($result->num_rows === 0) {
            throw new Exception("User id cannot be found");
        } else {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            $response = array(
                'count' => $count
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

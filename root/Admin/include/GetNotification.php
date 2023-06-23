<?php
require_once "../../../config/config.php";

if (isset($_GET["userID"])) {
    $userID = $_GET["userID"];
    $data = array();

    $GetNotif = $conn->prepare("SELECT * FROM notification WHERE userID = ? ORDER BY timestamp DESC");
    $GetNotif->bind_param("i", $userID);
    $GetNotif->execute();
    $notifResult = $GetNotif->get_result();

    try {
        if ($notifResult->num_rows === 0) {
            throw new Exception("User id cannot be found");
            $rowCount = 0;
        } else {
            $rowCount = $notifResult->num_rows;

            while ($row = $notifResult->fetch_assoc()) {
                $message = $row["message"];
                $timestamp = $row["timestamp"];
                $notifID = $row["id"];
                $data[] = array(
                    'message' => $message,
                    'timestamp' => $timestamp,
                    'notifID' => $notifID
                );
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array('count' => $rowCount, 'data' => $data));
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


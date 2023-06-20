<?php
require_once '../../../../config/config.php';

if (isset($_POST['deleteBtn'])) {
    $id = $_POST['id'];
    $status = "Deleted";
    $manilaTimezone = new DateTimeZone('Asia/Manila');
    $currentDateTime = new DateTime('now', $manilaTimezone);
    $timestamp = $currentDateTime->format('Y-m-d H:i:s');
    $updateDeleted = $conn->prepare("UPDATE receive_request set status=?,deleted_timestamp= ? where request_id=?");
    $updateDeleted->bind_param("ssi", $status,$timestamp, $id);
    try {
        if (!$updateDeleted->execute()) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $deleteRequest = $conn->prepare("DELETE FROM request WHERE request_id = ?");
            $deleteRequest->bind_param("s", $id);
            $deleteRequest->execute();
            echo "Deleted Successfully";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

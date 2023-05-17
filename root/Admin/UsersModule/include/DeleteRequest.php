<?php
require_once '../../../../config/config.php';

if (isset($_POST['deleteBtn'])) {
    $id = $_POST['id'];
    $status = "Deleted";
    $updateDeleted = $conn->prepare("UPDATE receive_request set status=? where request_id=?");
    $updateDeleted->bind_param("si", $status, $id);
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

<?php
require_once '../../../../config/config.php';

if (isset($_POST['deleteBtn'])) {
    $id = $_POST['id'];
    $status = "Deleted";
    $updateDeleted = $conn->prepare("UPDATE request set status=? where request_id=?");
    $updateDeleted->bind_param("si", $status, $id);
    try {
        if (!$updateDeleted->execute()) {
            throw new Exception('There was a problem executing the query' . $conn->error);
        } else {
            $conn->autocommit(FALSE); // start transaction
            $stmt1 = $conn->prepare("DELETE FROM receive_request WHERE request_id = ?");
            $stmt1->bind_param("s", $id);
            $stmt1->execute();

            if ($stmt1->affected_rows == 0) {
                throw new Exception("Request ID does not match any data.");
            }

            $stmt2 = $conn->prepare("DELETE FROM request_category WHERE request_id = ?");
            $stmt2->bind_param("s", $id);
            $stmt2->execute();

            $stmt3 = $conn->prepare("DELETE FROM on_process WHERE reciept_number = ?");
            $stmt3->bind_param("s", $id);
            $stmt3->execute();

            $conn->commit(); // commit transaction
            echo "Deleted Successfully";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

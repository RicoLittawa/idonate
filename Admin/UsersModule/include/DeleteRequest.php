<?php
require_once "../../include/connection.php";

if(isset($_POST['deleteBtn'])){
    $request_id = $_POST['request_id'];

    $conn->autocommit(FALSE); // start transaction

    try {
        $stmt1 = $conn->prepare("DELETE FROM request WHERE request_id = ?");
        $stmt1->bind_param("s", $request_id);
        $stmt1->execute();

        if ($stmt1->affected_rows == 0) {
            throw new Exception("Request ID does not match any data.");
        }

        $stmt2 = $conn->prepare("DELETE FROM request_category WHERE request_id = ?");
        $stmt2->bind_param("s", $request_id);
        $stmt2->execute();

        $conn->commit(); // commit transaction
        echo "Deleted Successfully";
    } catch (Exception $e) {
        $conn->rollback(); // rollback transaction
        echo $e->getMessage();
    }
}
?>

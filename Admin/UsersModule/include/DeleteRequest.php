<?php
require_once "../../include/connection.php";

if(isset($_POST['deleteBtn'])){
    $id = $_POST['id'];
    try {
        $stmt1 = $conn->prepare("DELETE FROM request WHERE request_id = ?");
        $stmt1->bind_param("s", $id);
        $stmt1->execute();

        if ($stmt1->affected_rows == 0) {
            throw new Exception("Request ID does not match any data.");
        }

        echo "Deleted Successfully";
    } catch (Exception $e) {
        $conn->rollback(); // rollback transaction
        echo $e->getMessage();
    }
}
?>

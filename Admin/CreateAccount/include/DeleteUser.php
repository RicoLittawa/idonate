<?php 
require_once "../../include/connection.php";

if(isset($_POST['deleteBtn'])){
    $id = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM adduser WHERE uID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        if ($stmt->affected_rows == 0) {
            throw new Exception("Request ID does not match any data.");
        }
        echo "Deleted Successfully";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
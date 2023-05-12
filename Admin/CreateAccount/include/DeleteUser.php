<?php 
require_once "../../include/connection.php";

if(isset($_POST['deleteBtn'])){
    $id = $_POST['id'];
    $stmt1= $conn->prepare("SELECT profile from adduser where uID=?");
    $stmt1->bind_param("s",$id);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row= $result->fetch_assoc();
    $profile= $row['profile'];

    try {
        $stmt = $conn->prepare("DELETE FROM adduser WHERE uID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        if ($stmt->affected_rows == 0) {
            throw new Exception("Request ID does not match any data.");
        }
        $validPath= '../../include/profile/'.$profile;
        unlink($validPath);
        echo "Deleted Successfully";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
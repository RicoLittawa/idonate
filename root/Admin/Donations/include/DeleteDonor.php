<?php
require_once '../../../../config/config.php';
include '../../include/ResponseMessages.php';
if (isset($_POST['deleteBtn'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT certificate from donation_items where Reference=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cert = $row['certificate'];
    $conn->autocommit(FALSE); // start transaction
    $stmt1 = $conn->prepare("DELETE FROM donation_items WHERE Reference = ?");
    $stmt1->bind_param("s", $id);
    $stmt1->execute();

    if ($stmt1->affected_rows == 0) {
        errorMessage("Request ID does not match any data.");
    }

    $stmt2 = $conn->prepare("DELETE FROM donation_items10 WHERE Reference = ?");
    $stmt2->bind_param("s", $id);
    $stmt2->execute();

    $validPath = '../../include/download-certificate/' . $cert;
    unlink($validPath);

    $conn->commit(); // commit transaction
    successMessage("Deleted successfully.");
}

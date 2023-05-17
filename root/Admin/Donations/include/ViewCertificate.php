<?php
require_once '../../../../config/config.php';
//view certificate
if (isset($_GET['viewCert'])) {
    $id = $_GET['viewCert'];
    $message = '';
    $sql = "SELECT certificate from donation_items where donor_id=?";
    $stmt = $conn->prepare($sql);
    try {
        if (!$stmt) {
            throw new Exception("There was a problem executing the query.");
        } else {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                throw new Exception("There are no such data.");
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo $row['certificate'];
                }
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        $stmt->close();
        $conn->close();
    }
}

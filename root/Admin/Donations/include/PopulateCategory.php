<?php
require_once "../../../../config/config.php";
$getCategory = $conn->prepare("SELECT * FROM category");
try {
    if (!$getCategory->execute()) {
        throw new Exception('There was a problem executing the query' . $conn->error);
    } else {
        $result = $getCategory->get_result();
        if (!$result->num_rows < 0) {
            throw new Exception("Failed to fetch data from database" . $conn->error);
        } else {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row["category"];
            }
            header('Content-Type: application/json');
            echo json_encode($data); // No need to wrap in 'data' key
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

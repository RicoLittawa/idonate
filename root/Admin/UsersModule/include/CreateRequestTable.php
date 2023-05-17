<?php
require_once '../../../../config/config.php';
require_once "../../include/protect.php";
$data = array();
try {
    $createdRequest = "SELECT request_id,evacuees_qty,requestdate,receivedate,status from request where userId=?";
    $stmt = $conn->prepare($createdRequest);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $createdRequestResult = $stmt->get_result();
    if ($createdRequestResult->num_rows === 0) {
        throw new Exception("No request found for user ID: " . $userID);
    } else {
        while ($reqRes = $createdRequestResult->fetch_assoc()) {
            $request_date = $reqRes['requestdate'];
            $request_dateTrimmed = str_replace('-', '', $request_date);
            $request_id = $reqRes['request_id'];
            $evacuees_qty = $reqRes['evacuees_qty'];
            $receive_date = $reqRes['receivedate'];
            $status = $reqRes['status'];
            $data[] = array(
                "request_dateTrimmed" => $request_dateTrimmed,
                "request_date" => $request_date,
                "request_id" => $request_id,
                "evacuees_qty" => $evacuees_qty,
                "receive_date" => $receive_date,
                "status" => $status
            );
        }
        // Output the data in JSON format
        header('Content-Type: application/json');
        echo json_encode(array('data' => $data));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

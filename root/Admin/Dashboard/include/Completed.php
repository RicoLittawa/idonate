<?php
require_once '../../../../config/config.php';
$data = array();
$statusCompleted = "Request completed";
$request = "SELECT request_id,requestdate,receivedate,status FROM receive_request WHERE status=?";
$stmt=$conn->prepare($request);
try {
    if (!$stmt) {
        throw new Exception('There was a problem executing the query.');
    } else {
        $stmt->bind_param('s', $statusCompleted);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows < 0) {
            throw new Exception("There was a problem getting the status.");
        } else {
            while ($row = $result->fetch_assoc()) {
                $request_id = $row['request_id'];
                $requestdate = $row['requestdate'];
                $receivedate = $row['receivedate'];
                $dateTrimmed = str_replace('-', '', $requestdate);
                $status = $row['status'];

                $data[] = array(
                    'request_id' => $request_id,
                    'requestdate' => $dateTrimmed,
                    'receivedate' => $receivedate,
                    'status' => $status
                );
            }
            header('Content-Type: application/json');
            echo json_encode(array('data' => $data));
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}


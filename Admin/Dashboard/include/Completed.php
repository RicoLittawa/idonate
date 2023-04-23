<?php
require_once '../../include/connection.php';
$statusCompleted = "Request completed";
$request = "SELECT request_id,requestdate,receivedate,status FROM request WHERE status=?";
$stmt=$conn->prepare($request);
try {
    if (!$stmt) {
        throw new Exception('There was a problem executing the query.');
    } else {
        $stmt->bind_param('s', $statusCompleted);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
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
           
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
header('Content-Type: application/json');
echo json_encode(array('data' => $data));
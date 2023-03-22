<?php
require_once '../connection.php';
$getRequest = "SELECT request_id,firstname,lastname,position,evacuees_qty,requestdate,status FROM request";
$stmt = $conn->prepare($getRequest);
$stmt->execute();
$getResult = $stmt->get_result();
while ($get = $getResult->fetch_assoc()) {
    $reference = $get['request_id'];
    $firstname = $get['firstname'];
    $lastname = $get['lastname'];
    $position = $get['position'];
    $evacuees_qty = $get['evacuees_qty'];
    $requestdate = $get['requestdate'];
    $dateTrimmed = str_replace('-', '', $requestdate);
    $status = $get['status'];

    $data[] = array(
        'reference' =>$reference,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'position' => $position,
        'evacuees_qty' => $evacuees_qty,
        'requestdate' => $requestdate,
        'dateTrimmed' => $dateTrimmed,
        'status' => $status
      );
}
header('Content-Type: application/json');
echo json_encode(array('data' => $data));
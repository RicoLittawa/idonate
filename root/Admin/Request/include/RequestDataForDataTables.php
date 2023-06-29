<?php
require_once '../../../../config/config.php';
$data = array();
try {
  $getRequest = "SELECT request_id,firstname,lastname,position,evacuees_qty,requestdate,receivedate,status,status_timestamp,deleted_timestamp FROM receive_request";
  $stmt = $conn->prepare($getRequest);
  $stmt->execute();
  $getResult = $stmt->get_result();
  if ($getResult->num_rows < 0) {
    throw new Exception("Failed to fetch data from database" . $conn->error);
  } else {
    while ($get = $getResult->fetch_assoc()) {
      $reference = $get['request_id'];
      $firstname = $get['firstname'];
      $lastname = $get['lastname'];
      $position = $get['position'];
      $evacuees_qty = $get['evacuees_qty'];
      $requestdate = $get['requestdate'];
      $date = date('Y-m-d', strtotime($requestdate));
      $dateTrimmed = str_replace('-', '', $date);
      $receivedate = $get['receivedate'];
      $status = $get['status'];
      $deleted_timestamp = $get['deleted_timestamp'];
      $status_timestamp = $get['status_timestamp'];

      $data[] = array(
        'reference' => $reference,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'position' => $position,
        'evacuees_qty' => $evacuees_qty,
        'requestdate' => $requestdate,
        'dateTrimmed' => $dateTrimmed,
        'status' => $status,
        'receivedate' => $receivedate,
        'deleted_timestamp'=>$deleted_timestamp,
        'status_timestamp'=>$status_timestamp
      );
    }
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

<?php
require_once '../../include/connection.php';
$data= array();
try{
  $getRequest = "SELECT request_id,firstname,lastname,position,evacuees_qty,requestdate,receivedate,status FROM receive_request";
  $stmt = $conn->prepare($getRequest);
  $stmt->execute();
  $getResult = $stmt->get_result();
  if($getResult->num_rows <0){
    throw new Exception("There are no such data.");
  }else{
    while ($get = $getResult->fetch_assoc()) {
      $reference = $get['request_id'];
      $firstname = $get['firstname'];
      $lastname = $get['lastname'];
      $position = $get['position'];
      $evacuees_qty = $get['evacuees_qty'];
      $requestdate = $get['requestdate'];
      $dateTrimmed = str_replace('-', '', $requestdate);
      $receivedate= $get['receivedate'];
      $status = $get['status'];
  
      $data[] = array(
          'reference' =>$reference,
          'firstname' => $firstname,
          'lastname' => $lastname,
          'position' => $position,
          'evacuees_qty' => $evacuees_qty,
          'requestdate' => $requestdate,
          'dateTrimmed' => $dateTrimmed,
          'status' => $status,
          'receivedate'=>$receivedate
        );
  }
  header('Content-Type: application/json');
  echo json_encode(array('data' => $data));
  
  }
  
}
catch(Exception $e){
  echo $e->getMessage();
}


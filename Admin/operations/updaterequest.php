
<?php

include '../include/connection.php';

if (isset($_POST['update_request'])){ 

  $Id= $_POST['request_id'];
  $Fname= $_POST['req_name'];
  $Province= $_POST['req_province'];
  $Street= $_POST['req_street'];
  $Region= $_POST['req_region'];
  $Email = $_POST['req_email'];
  $Date= $_POST['req_date'];
  $Category= $_POST['req_category'];
  $Variant= $_POST['req_variant'];
  $Quantity= $_POST['req_quantity'];
  $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
  if(empty($Fname)||empty($Province)||empty($Street)||empty($Region)||empty($Email)||empty($Date)||empty($Category)||empty($Variant)||empty($Quantity)){
    $res =[
      'status' => 404,
      'message' => 'All fields are required'

  ];
  echo json_encode($res);
  return false;
 } else if($Region =="default"||$Category=="default"||$Variant=="default"){
  $res =[
      'status' => 404,
      'message' => 'Please select an option'

  ];
  echo json_encode($res);
  return false;

}
else if (!preg_match ($pattern, $Email) ){  
  $res =[
      'status' => 404,
      'message' => 'Email is not valid'

  ];
  echo json_encode($res);
  return false;
}else if (!is_numeric($Quantity)){
  $res =[
      'status' => 404,
      'message' => 'Only enter numeric values'

  ];
  echo json_encode($res);
  return false;
}
else{

    $sql ="UPDATE set_request SET req_name=?,req_province=?,req_street=?,req_region=?,req_email=?,req_date=?,req_category=?,
    req_variant=?,req_quantity=? WHERE request_id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $Fname, $Province,$Street,$Region, $Email,$Date,$Category,$Variant,$Quantity, $Id);
    $stmt->execute();
    $res =[
      'status' => 422,
      'message' => 'Data has been updated'

  ];
  echo json_encode($res);
  return false;
 }
       
 mysqli_stmt_close($stmt);
 mysqli_close($conn);
    
}

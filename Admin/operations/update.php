
<?php

include '../include/connection.php';

if (isset($_POST['update_data'])){ 

  $Id= $_POST['donor_id'];
  $Fname= $_POST['donor_name'];
  $City= $_POST['donor_city'];
  $Street= $_POST['donor_street'];
  $Region= $_POST['donor_region'];
  $Email = $_POST['donor_email'];
  $Date= $_POST['donationDate'];
  $Category= $_POST['donation_category'];
  $Variant= $_POST['donation_variant'];
  $Quantity= $_POST['donation_quantity'];
  $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
  if(empty($Fname)||empty($City)||empty($Street)||empty($Region)||empty($Email)||empty($Date)||empty($Category)||empty($Variant)||empty($Quantity)){
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

    $sql ="UPDATE donation_items SET donor_name=?,donor_city=?,donor_street=?,donor_region=?,donor_email=?,donationDate=?,donation_category=?,
    donation_variant=?,donation_quantity=? WHERE donor_id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $Fname, $City,$Street,$Region, $Email,$Date,$Category,$Variant,$Quantity, $Id);
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

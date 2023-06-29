<?php

require_once '../../../../config/config.php';
if (isset($_POST["updateBtn"])) {
  $donorid = $_POST['donor_id'];
  $reference_id = $_POST['reference_id'];
  $Fname = $_POST['fname'];
  $Province = $_POST['province'];
  $Municipality = $_POST['municipality'];
  $Barangay = $_POST['barangay'];
  $Region = $_POST['region'];
  $Email = $_POST['email'];
  $Date = date('Y-m-d', strtotime($_POST['donation_date']));
  $Contact = $_POST['contact'];
  $update =$conn->prepare("UPDATE donation_items set Reference=?,donor_name=?,donor_region=?,donor_province=?,donor_municipality=?,donor_barangay=?,donor_email=?,donor_contact=?,donationDate=? where donor_id=?");
  try {
    if (!$update) {
      throw new Exception("'There was a problem connecting to the database");
    } else {
      $update->bind_param('issssssssi', $reference_id, $Fname, $Region, $Province, $Municipality, $Barangay, $Email, $Contact, $Date, $donorid);
      $update->execute();
      $response = [
        "status" => "Success",
        "message" => "Your data is successfully updated",
        "icon" => "success",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
  } catch (Exception $e) {
    $response = [
      "status" => "Error",
      "message" => $e->getMessage(),
      "icon" => "error",
  ];

  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}
  $update->close();
  $conn->close();
}

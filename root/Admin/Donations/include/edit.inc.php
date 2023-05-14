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
  $sql = "UPDATE donation_items set Reference=?,donor_name=?,donor_region=?,donor_province=?,donor_municipality=?,donor_barangay=?,donor_email=?,donor_contact=?,donationDate=? where donor_id=?";
  $stmt = $conn->prepare($sql);
  try {
    if (!$stmt) {
      throw new Exception("There are error when executing the query.");
    } else {
      $stmt->bind_param('issssssssi', $reference_id, $Fname, $Region, $Province, $Municipality, $Barangay, $Email, $Contact, $Date, $donorid);
      $stmt->execute();
      echo "success";
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  $stmt->close();
  $conn->close();
}

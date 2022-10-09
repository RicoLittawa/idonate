
<?php
session_start();
include '../include/connection.php';

if (isset($_POST['updatedata'])){ 

  
  $id= $_POST['update_id'];
  $Fname= $_POST['fname'];
  $Address= $_POST['address'];
  $Email= $_POST['email'];
  $Date= $_POST['donation_date'];
  $Categ= $_POST['category'];
  $Quanti= $_POST['variant'];
  $Product = $_POST['productName'];
  $Quantity= $_POST['quantity'];

  if(empty($Fname)||empty($Address)||empty($Email)||empty($Date)||empty($Categ)||empty($Quanti)||empty($Product)||empty($Quantity)){
    $_SESSION['status']="Empty Fields";
    $_SESSION['status_code']="error";
    header("Location: ../donations.php?error=emptyfields");
    exit();
 }
 
else if (!preg_match ("/^[0-9]*$/", $Quantity)){
  $_SESSION['status']="Please enter numeric value";
  $_SESSION['status_code']="error";
  header("Location: ../donations.php?error=notvalidnumber");
  exit();
  
}
else if(!preg_match("/^[a-zA-Z-' ]*$/",$Fname)){
  $_SESSION['status']="Not a valid name";
  $_SESSION['status_code']="error";
  header("Location: ../donations.php?error=notvalidname");
  exit();
}

else{

    $sql ="UPDATE items SET fullname=?,address=?,email=?,donationDate=?,category=?,
    variant=?,productName=?,quantity=? WHERE id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $Fname, $Address, $Email,$Date,$Categ,$Quanti,$Product,$Quantity, $id);
    $stmt->execute();
    $_SESSION['status']=" Update Success";
      $_SESSION['status_code']="success";
        header("Location: ../donations.php?fillup=success");
 }
       
 mysqli_stmt_close($stmt);
 mysqli_close($conn);
    
}
else {
  header("Location: ../donations.php");
              exit();
}
<?php
include '../include/connection.php';
if (isset($_POST['updatedata'])){
  $id= $_POST['update_id'];
  $Fname= $_POST['fname'];
  $Address= $_POST['address'];
  $Email= $_POST['email'];
  $Date= date('Y-m-d', strtotime($_POST['donation_date']));
  $Categ= $_POST['category'];
  $Quanti= $_POST['variant'];
  $Product = $_POST['productName'];
  $Quantity= $_POST['quantity'];

    $sql ="UPDATE items SET fullname='$Fname',address='$Address',email='$Email',donationDate='$Date',category='$Categ',
    variant='$Quanti',productName='$Product',quantity='$Quantity' WHERE id=$id";
    $result= mysqli_query($conn,$sql);
    if ($result){
        header("Location: ../donations.php");
    }
    else{
        die(mysqli_error($conn));
    }
}
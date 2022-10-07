<?php
if (isset($_POST['submit-donations'])){
    require 'connection.php';
    $Fname= $_POST['fname'];
    $Address= $_POST['address'];
    $Email= $_POST['email'];
    $Date= date('Y-m-d', strtotime($_POST['donation_date']));
    $Categ= $_POST['category'];
    $Quanti= $_POST['variant'];
    $Product = $_POST['productName'];
    $Quantity= $_POST['quantity'];

    if(empty($Fname)||empty($Address)||empty($Email)||empty($Date)||empty($Categ)||empty($Quanti)||empty($Product)||empty($Quantity)){
        header("Location: ../donations.php?error=emptyfields");
        exit();
     }
     else{
        $sql = "INSERT INTO items (fullname,address,email,donationDate,category,variant,productName,quantity)
         VALUES (?,?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../donations.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ssssssss",$Fname,$Address,$Email,$Date,$Categ,$Quanti,$Product,$Quantity);
            mysqli_stmt_execute($stmt);
            header("Location: ../donations.php?=fillup=success");
            exit();
        }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
}

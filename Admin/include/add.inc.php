<?php
session_start();
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
        $_SESSION['status']="Empty Fields";
        $_SESSION['status_code']="error";
        header("Location: ../donations.php?error=emptyfields");
        exit();
     }
     else if (!preg_match ("/^[a-zA-Z]*$/", $Fname) ){
        $_SESSION['status']="Not a valid name";
        $_SESSION['status_code']="error";
        header("Location: ../donations.php?error=notvalidname");
        exit();
        
     }
     
     else{
        $sql = "INSERT INTO items (fullname,address,email,donationDate,category,variant,productName,quantity)
         VALUES (?,?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            $_SESSION['status']="Something went wrong";
            $_SESSION['status_code']="error";
            header("Location: ../donations.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ssssssss",$Fname,$Address,$Email,$Date,$Categ,$Quanti,$Product,$Quantity);
            mysqli_stmt_execute($stmt);
            $_SESSION['status']="Data added successfully";
            $_SESSION['status_code']="success";
            header("Location: ../donations.php?=fillup=success");
            exit();
        }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
}

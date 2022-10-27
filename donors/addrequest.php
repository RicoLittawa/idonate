<?php


    require '../donors/include/connection.php';
   
    $Fname= $_POST['fname'];
    $Address= $_POST['address'];
    $Email= $_POST['email'];
    $Date= date('Y-m-d', strtotime($_POST['donation_date']));
    $Categ= $_POST['category'];
    $Quanti= $_POST['variant'];
    $Product = $_POST['productName'];
    $Quantity= $_POST['quantity'];
    $DNote= $_POST['note'];

   
     
        $sql = "INSERT INTO request (full_name,donor_address,donor_email,request_date,item_category,item_variant,item_name,item_quantity,note)
         VALUES (?,?,?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:donation.php?error=sqlerror");
            exit();
            
        }
        else{
            mysqli_stmt_bind_param($stmt,"sssssssss",$Fname,$Address,$Email,$Date,$Categ,$Quanti,$Product,$Quantity,$DNote);
            mysqli_stmt_execute($stmt);
            header("Location:donation.php?success=datasubmitted");
            exit();
           
        }
     
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
    
<?php

    require 'connection.php';
    $Fname= $_POST['fname'];
    $Address= $_POST['address'];
    $Email= $_POST['email'];
    $Date= date('Y-m-d', strtotime($_POST['donation_date']));
    $Categ= $_POST['category'];
    $Quanti= $_POST['variant'];
    $Product = $_POST['productName'];
    $Quantity= $_POST['quantity'];
    $result= '';


   

        $sql = "INSERT INTO items (fullname,address,email,donationDate,category,variant,productName,quantity)
         VALUES (?,?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
         
        }
        else{
            mysqli_stmt_bind_param($stmt,"ssssssss",$Fname,$Address,$Email,$Date,$Categ,$Quanti,$Product,$Quantity);
            mysqli_stmt_execute($stmt);
           if ($result=='')
           {
            echo 'ok';
           }
           else
           {
            echo $result;
           }

         
        }
     
     mysqli_stmt_close($stmt);
     mysqli_close($conn);

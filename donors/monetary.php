<?php


    require '../donors/include/connection.php';
    if (isset($_POST["monetary_data"]))
    {
    $Fullname=$_POST['money_name'];
echo $Fullname;
    return;
    $Province= $_POST['money_province'];
    $Street= $_POST['money_street'];
    $Region=  $_POST['money_region'];
    $Contact= $_POST['money_contact'];
    $Email=  $_POST['money_email'];
    $Date= date('Y-m-d', strtotime($_POST['money_date']));
    $Reference=$_POST['money_reference'];
    $Amount=$_POST['money_amount'];
    $Note=$_POST['money_note'];
  

        $File = $_FILES['money_image']['name'];
        $filePath='ReferencePhoto/';
        $filename=  $filePath.basename($_FILES['money_image']['name']);
        $filetype=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $allowtypes= array('jpg','png','jpeg','gif');
        if (in_array($filetype,$allowtypes)){
            if(move_uploaded_file($_FILES['money_image']['tmp_name'],$filePath.$File)){
                

                $sql = "INSERT INTO monetary_donations (money_name,money_province,money_street,money_region,money_contact,money_email,money_date,money_reference,money_img,money_amount,money_note)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)" ;
               $stmt= mysqli_stmt_init($conn);
               if(!mysqli_stmt_prepare($stmt,$sql)){
                  
               }
               else{
                   mysqli_stmt_bind_param($stmt,"sssssssssss",$Fullname,$Province,$Street,$Region,$Contact,$Email,$Date,$Reference,$File,$Amount,$Note);
                   mysqli_stmt_execute($stmt);
                  
               }
               
        
           
             
               
             
            
            } // file type error
    
            }

            
            mysqli_stmt_close($stmt);
             mysqli_close($conn);
       
    }
    
      
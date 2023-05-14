<?php


    require_once 'include/connection.php';
    try {
    if (isset($_POST["monetary_data"]))
    {
    $Fullname= $_POST['money_name'];
    $Province= $_POST['money_province'];
    $Municipality= $_POST['money_municipality'];
    $Barangay= $_POST['money_barangay'];
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
        $fileSize = $_FILES['money_image']['size'];
        $fileError = $_FILES['money_image']['error'];
      
            if(move_uploaded_file($_FILES['money_image']['tmp_name'],$filePath.$File)){
                
                if($fileError === 0){
                    if($fileSize < 1000000) {
                        $sql = "INSERT INTO monetary_donations (money_name,money_region,money_province,money_municipality,money_barangay,money_contact,money_email,money_date,money_reference,money_img,money_amount,money_note)
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)" ;
                                
                        $stmt= mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                               throw new Exception("Sql error");
                                    exit();
                            }
                        else{
                             mysqli_stmt_bind_param($stmt,"ssssssssssss",$Fullname,$Region,$Province,$Municipality,$Barangay,$Contact,$Email,$Date,$Reference,$File,$Amount,$Note);
                             mysqli_stmt_execute($stmt);
                             echo"Success";
                             exit();
                          }
                    }  throw new Exception("File is too large");
	                exit();
                } throw new Exception("Error uploading file");
	                exit();      
            } 
            
            
        }
       
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }     
   
   catch(Exception $e){
    echo $e->getMessage();}
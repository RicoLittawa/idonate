<?php


    require '../donors/include/connection.php';
    if (isset($_POST["monetary_data"]))
    {
    $Fullname=$_POST['money_name'];
    $Province= $_POST['money_province'];
    $Street= $_POST['money_street'];
    $Region=  $_POST['money_region'];
    $Contact= $_POST['money_contact'];
    $Email=  $_POST['money_email'];
    $Date= date('Y-m-d', strtotime($_POST['money_date']));
    $Reference=$_POST['money_reference'];
    $Amount=$_POST['money_amount'];
    $Note=$_POST['money_note'];
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  

    if (empty($Fullname)||empty($Province)||empty($Street)||empty($Region)||empty($Contact)||empty($Email)||empty($Date)||
    empty($Reference)||empty($Amount)||empty($Note)){
        $res =[
            'status' => 422,
            'message' => 'All fields are required'
 
        ];
        echo json_encode($res);
        return false;
    }
    else if (!preg_match ($pattern, $Email) ){  
        $res =[
            'status' => 422,
            'message' => 'Email is not valid'
 
        ];
        echo json_encode($res);
        return false;
    }else if (!is_numeric($Amount)||!is_numeric($Reference)){
        $res =[
            'status' => 422,
            'message' => 'Only enter numeric values'
 
        ];
        echo json_encode($res);
        return false;
    }else if(empty($File)){
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
                   $res =[
                       'status' => 422,
                       'message' => 'Request error'
            
                   ];
                   echo json_encode($res);
                   return false;
               }
               else{
                   mysqli_stmt_bind_param($stmt,"sssssssssss",$Fullname,$Province,$Street,$Region,$Contact,$Email,$Date,$Reference,$File,$Amount,$Note);
                   mysqli_stmt_execute($stmt);
                   $res =[
                       'status' => 200,
                       'message' => 'Request has been sent'
            
                   ];
                   echo json_encode($res);
                   return false;
                 
               }
               
        
           
             
               
             
             mysqli_stmt_close($stmt);
             mysqli_close($conn);
            } else{
                $res =[
                    'status' => 422,
                    'message' => 'File type error'
         
                ];
                echo json_encode($res);
                return false;
            }
    
            }

            }
           
       
    }
    
      
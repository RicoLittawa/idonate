<?php


    require '../donors/include/connection.php';
    if (isset($_POST["request_data"]))
    {
    $Fname=$_POST['fname'];
    $Province= $_POST['province'];
    $Street= $_POST['street'];
    $Region=  $_POST['region'];
    $Email=  $_POST['email'];
    $Date= date('Y-m-d', strtotime($_POST['donation_date']));
    $Categ= $_POST['category'];
    $Variant=$_POST['variant'];
    $Quantity= $_POST['quantity'];
    $DNote=$_POST['note'];
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    if (empty($Fname)||empty($Province)||empty($Street)||empty($Region)||empty($Email)||empty($Date)||
    empty($Categ)||empty($Variant)||empty($Quantity)||empty($DNote)){
        $res =[
            'status' => 422,
            'message' => 'All fields are required'
 
        ];
        echo json_encode($res);
        return false;
    }else if($Region =="default"||$Categ=="default"||$Variant=="default"){
        $res =[
            'status' => 422,
            'message' => 'Please select an option'
 
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
    }else if (!is_numeric($Quantity)){
        $res =[
            'status' => 422,
            'message' => 'Only enter numeric values'
 
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $sql = "INSERT INTO set_request (req_name,req_province,req_street,req_region,req_email,req_date,req_category,req_variant,req_quantity,req_note)
        VALUES (?,?,?,?,?,?,?,?,?,?)" ;
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
           mysqli_stmt_bind_param($stmt,"ssssssssss",$Fname,$Province,$Street,$Region,$Email,$Date,$Categ,$Variant,$Quantity,$DNote);
           mysqli_stmt_execute($stmt);
           $res =[
               'status' => 200,
               'message' => 'Request has been sent'
    
           ];
           echo json_encode($res);
           return false;
         
       }
       }

   
     
       
     
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
    }
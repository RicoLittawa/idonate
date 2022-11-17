<?php


    include '../donors/include/connection.php';
    if (isset($_POST["saveBtn"]))
    {
   $referenceId= $_POST['ref_id'];
   $fname= $_POST['req_fname'];
   $province= $_POST['req_province'];
   
   $street= $_POST['req_street'];
  $region= $_POST['req_region'];
   $email= $_POST['req_email'];
   $date= date('Y-m-d', strtotime($_POST['req_date']));
   $contact=$_POST['req_contact'];
   $note=$_POST['req_note'];
   $category= $_POST['category_arr'];
   $variant= $_POST['variant_arr'];
   $quantity= $_POST['quantity_arr'];


  
   $File = $_FILES['file_img']['name'];

   $filePath='ValidId/';
   $filename=  $filePath.basename($_FILES['file_img']['name']);
   $filetype=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
   $allowtypes= array('jpg','png','jpeg','gif');
   if (in_array($filetype,$allowtypes)){
       if(move_uploaded_file($_FILES['file_img']['tmp_name'],$filePath.$File)){
        $sql= "INSERT into set_request (reference_id,req_name,req_province,req_street,req_region,valid_id,req_email,req_date,req_contact,req_note)
        Values(?,?,?,?,?,?,?,?,?,?)";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssssssssss",$referenceId,$fname,$province,$street,$region,$File,$email,$date,$contact,$note);
            mysqli_stmt_execute($stmt);
            $res= "save";
            echo json_encode($res);
            return false;
        }

       }
    }

    }
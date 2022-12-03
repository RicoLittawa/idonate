<?php


    require_once 'include/connection.php';


        if (isset($_POST["saveBtn"]))
    {
   $referenceId= $_POST['ref_id'];
   $fname= $_POST['fname'];
   $province= $_POST['province'];
   $municipality= $_POST['municipality'];
   $barangay= $_POST['barangay'];
   $region= $_POST['region'];
   $email= $_POST['email'];
   $date= date('Y-m-d', strtotime($_POST['date']));
   $contact=$_POST['contact'];
   $note=$_POST['note'];
   $category= $_POST['category_arr'];
   $variant=$_POST['variant'];
   $quantity= $_POST['quantity'];
   $ItemName= $_POST['itemName_arr'];

   $status= 'For verification';

   $categ =explode(",",$category);
   $itemname =explode(",",$ItemName);



   $Image = $_FILES['idImg']['name'];
   

   $filePath='ValidId/';
   $filename=  $filePath.basename($_FILES['idImg']['name']);
   $filetype=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
   $fileSize = $_FILES['idImg']['size'];
   $fileError = $_FILES['idImg']['error'];
       if(move_uploaded_file($_FILES['idImg']['tmp_name'],$filePath.$Image)){
        if($fileError === 0){
            if($fileSize < 1000000) {
        $sql= "INSERT into set_request (reference_id,req_name,req_region,req_province,req_municipality,req_barangay,req_email,req_contact,req_date,valid_id,req_note,req_status)
        Values(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
           
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssssssssssss",$referenceId,$fname,$region,$province,$municipality,$barangay,$email,$contact,$date,$Image,$note,$status);
            mysqli_stmt_execute($stmt);
            
        }

        $variantSQL= "INSERT into req_varianttotal(req_reference,req_variant,req_quantity) values(?,?,?)";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$variantSQL)){
            echo ''. $mysqli -> connect_list;
               exit();
              
           }
        else{
            mysqli_stmt_bind_param($stmt,"sss",$referenceId,$variant,$quantity);
            mysqli_stmt_execute($stmt);
        }
        $count = 0;
        $resultCount = 0;
        foreach($categ as $item){
            $sql2= "INSERT INTO set_request10 (req_reference,req_category,req_nameItem,req_variantCode) Values (?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
              
            }
            else{
                mysqli_stmt_bind_param($stmt, 'ssss', $referenceId,$item,$itemname[$count],$variant);
                $result = mysqli_stmt_execute($stmt);
                if($result) {
                    $resultCount = $resultCount + 1;
                    $count=$count+1;
                }
            }
        }
       
        
        $referenceId=$referenceId+1;
       $sql3="UPDATE set_request_pickings  set reference_id=? "; 
       $stmt=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql3)){
        throw new Exception("Sql error");
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, 'i', $referenceId);
         mysqli_stmt_execute($stmt);

    }
        
            }
           
        }
       
       
    }
   echo"Success";
    exit();
    
   
        
    }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
   
    
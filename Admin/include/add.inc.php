<?php

    require_once 'connection.php';

        if (isset($_POST["saveBtn"]))
    {
        $reference_id= $_POST['reference_id'];
        $Fname= $_POST['fname'];
        $Province= $_POST['province'];
        $Municipality= $_POST['municipality'];
        $Barangay= $_POST['barangay'];
        $Region = $_POST['region'];
        $Email= $_POST['email'];
        $Date= date('Y-m-d', strtotime($_POST['donation_date']));
        $Quantity= $_POST['quantity'];
        $Contact= $_POST['contact'];
        $ItemName= $_POST['itemName_arr'];
        $Variant= $_POST['variant'];
        // $test_qty= $_POST['test_qty'];
     

       
        
         $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_region,donor_province,donor_municipality,donor_barangay,donor_email,donor_contact,donationDate)
         VALUES (?,?,?,?,?,?,?,?,?)" ;
         $stmt= mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt,$sql1)){
          echo ''. $mysqli -> connect_list;
             exit();
           
         }
         else {
             mysqli_stmt_bind_param($stmt,"sssssssss",$reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date);
             mysqli_stmt_execute($stmt);
         }
        $variantSQL= "INSERT into categ_varianttotal(donor_reference,variant,quantity) values(?,?,?)";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$variantSQL)){
            echo ''. $mysqli -> connect_list;
               exit();
              
           }
        else{
            mysqli_stmt_bind_param($stmt,"sss",$reference_id,$Variant,$Quantity);
            mysqli_stmt_execute($stmt);
        }
        
        
        $count = 0;
        $resultCount = 0;
        foreach($ItemName as $item){
            $sql2= "INSERT INTO donation_items10 (Reference,name_items,variantCode) Values (?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
                
            }
            else{
                mysqli_stmt_bind_param($stmt, 'sss', $reference_id, $item,$Variant);
                $result = mysqli_stmt_execute($stmt);
                if($result) {
                    $resultCount = $resultCount + 1;
                    $count=$count+1;
                }
            }
        }
       
        
        $reference_id=$reference_id+1;
       $sql3="UPDATE donation_items_picking  set reference_id=? "; 
       $stmt=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql3)){
        
    } else{
        mysqli_stmt_bind_param($stmt, 'i', $reference_id);
         mysqli_stmt_execute($stmt);
    }
    echo "Data added";
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    
    
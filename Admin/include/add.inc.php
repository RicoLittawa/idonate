<?php

    require 'connection.php';
    if (isset($_POST["save_data"]))
    {
        $Fname= $_POST['fname'];
        $City= $_POST['city'];
        $Street = $_POST['street'];
        $Region = $_POST['region'];
        $Email= $_POST['email'];
        $Date= date('Y-m-d', strtotime($_POST['donation_date']));
        $Category= $_POST['category'];
        $Variant= $_POST['variant'];
        $Quantity= $_POST['quantity'];
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^"; 
        if (empty($Fname)||empty($City)||empty($Street)||empty($Region)||empty($Email)||empty($Date)||empty($Category)||empty($Variant)||empty($Quantity))
        {
            $res =[
                'status' => 422,
                'message' => 'All fields are required'

            ];
            echo json_encode($res);
            return false;
        }
        else if($Region =="default"||$Category=="default"||$Variant=="default"){
            $res =[
                'status' => 422,
                'message' => 'Please select an option'
     
            ];
            echo json_encode($res);
            return false;
        
        }else if (!preg_match ($pattern, $Email) ){  
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
        }else{
            $sql = "INSERT INTO donation_items (donor_name,donor_city,donor_street,donor_region,donor_email,donationDate,donation_category,donation_variant,donation_quantity)
        VALUES (?,?,?,?,?,?,?,?,?)" ;
       $stmt= mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql)){
        $res =[
            'status' => 422,
            'message' => 'Sql Error'

        ];
        echo json_encode($res);
        return false;
       }
   else{
           mysqli_stmt_bind_param($stmt,"sssssssss",$Fname,$City,$Street,$Region,$Email,$Date,$Category,$Variant,$Quantity);
           mysqli_stmt_execute($stmt);
           $res =[
            'status' => 200,
            'message' => 'Data has been added'

        ];
        echo json_encode($res);
        return false;
       
       }
    
        }
        
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
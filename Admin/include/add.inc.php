<?php

    require 'connection.php';
    if (isset($_POST["save_data"]))
    {
        $Fname= $_POST['fname'];
        $Address= $_POST['address'];
        $Email= $_POST['email'];
        $Date= date('Y-m-d', strtotime($_POST['donation_date']));
        $Categ= $_POST['category'];
        $Quanti= $_POST['variant'];
        $Product = $_POST['productName'];
        $Quantity= $_POST['quantity'];

        if (empty($Fname)||empty($Address)||empty($Email)||empty($Date)||empty($Categ)||empty($Quanti)||empty($Product)||empty($Quantity))
        {
            $res =[
                'status' => 422,
                'message' => 'All fields are required'

            ];
            echo json_encode($res);
            return false;
        }
        $sql = "INSERT INTO items (fullname,address,email,donationDate,category,variant,productName,quantity)
        VALUES (?,?,?,?,?,?,?,?)" ;
       $stmt= mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql)){
        $res =[
            'status' => 422,
            'message' => 'All fields are required'

        ];
        echo json_encode($res);
        return false;
       }
       else{
           mysqli_stmt_bind_param($stmt,"ssssssss",$Fname,$Address,$Email,$Date,$Categ,$Quanti,$Product,$Quantity);
           mysqli_stmt_execute($stmt);
         
           $res =[
            'status' => 200,
            'message' => 'Data submitted'

        ];
        echo json_encode($res);
        return false;
       
       }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
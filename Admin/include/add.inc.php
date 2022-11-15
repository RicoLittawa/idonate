<?php

    include 'connection.php';
    if (isset($_POST["saveBtn"]))
    {
        $reference_id= $_POST['reference_id'];
        $Fname= $_POST['fname'];
        $Province= $_POST['province'];
        $Street = $_POST['street'];
        $Region = $_POST['region'];
        $Email= $_POST['email'];
        $Date= date('Y-m-d', strtotime($_POST['donation_date']));
        $Category= $_POST['category_arr'];
        $Variant= $_POST['variant_arr'];
        $Quantity= $_POST['quantity_arr'];
        if (empty($Fname)||empty($Province)||empty($Street)||empty($Region)||empty($Email)||empty($Date)||empty($Category)||empty($Variant)||empty($Quantity)){
            $data =[
                'status' => 404,
                'message' => 'All fields are required'
            ];
            echo json_encode($data);
            return false;
        }
        else{
            $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_province,donor_street,donor_region,donor_email,donationDate)
        VALUES (?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql1)){
            $data =[
                'status' => 404,
                'message' => 'SQL error'
            ];
            echo json_encode($data);
            return false;
        }
        else {
            mysqli_stmt_bind_param($stmt,"sssssss",$reference_id,$Fname,$Province,$Street,$Region,$Email,$Date);
            mysqli_stmt_execute($stmt);
        }

        $count = 0;
        $resultCount = 0;
        foreach($Category as $item){
            $sql2= "INSERT INTO donation_items10 (Reference,category,variant,quantity) Values (?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
                $data =[
                    'status' => 404,
                    'message' => 'SQL error'
                ];
                echo json_encode($data);
                return false;
            }
            else{
                mysqli_stmt_bind_param($stmt, 'ssss', $reference_id, $item, $Variant[$count], $Quantity[$count]);
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
        $data =[
            'status' => 404,
            'message' => 'SQL error'
        ];
        echo json_encode($data);
        return false;
    } else{
        mysqli_stmt_bind_param($stmt, 'i', $reference_id);
         mysqli_stmt_execute($stmt);
    }
        $data =[
            'status' => 422,
            'message' => 'Data has been added'
        ];
        echo json_encode($data);
        return false;
        }
      
        
        
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
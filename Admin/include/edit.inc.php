<?php

    include 'connection.php';
    if (isset($_POST["updateBtn"]))
    {
      $donorid = $_POST['donor_id'];
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
      $ref10= $_POST['ref10'];
      
    
      $sql ="UPDATE donation_items set Reference=?,donor_name=?,donor_province=?,donor_street=?,donor_region=?,donor_email=?,donationDate=? where donor_id=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
         echo 'sql error';
      }else{
         mysqli_stmt_bind_param($stmt, 'issssssi', $reference_id,$Fname,$Province,$Street,$Region,$Email,$Date,$donorid);
          mysqli_stmt_execute($stmt);
         
     }
    
     $count = 0;
     $resultCount = 1;
     foreach($Category as $item){
      $sqlupdate= "UPDATE donation_items10 set category=?,variant=?,quantity= ? where Reference=?";
         $stmt=mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt,$sqlupdate)){
             
         }
         else{
             mysqli_stmt_bind_param($stmt, 'ssss', $item, $Variant[$count], $Quantity[$count],$reference_id );
             $result = mysqli_stmt_execute($stmt);
             if($result) {
                 $resultCount++;
                 $count++;
             }
         }
     }
     
    


   
       
    }

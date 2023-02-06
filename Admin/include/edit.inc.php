<?php
   
    include 'connection.php';
    if (isset($_POST["updateBtn"]))
    {
      $donorid = $_POST['donor_id'];
      $reference_id= $_POST['reference_id'];
      $Fname= $_POST['fname'];
      $Province= $_POST['province'];
      $Municipality= $_POST['municipality'];
      $Barangay= $_POST['barangay'];
      $Region = $_POST['region'];
      $Email= $_POST['email'];
      $Date= date('Y-m-d', strtotime($_POST['donation_date']));
      $Contact= $_POST['contact'];
      
      
    
      $sql ="UPDATE donation_items set Reference=?,donor_name=?,donor_region=?,donor_province=?,donor_municipality=?,donor_barangay=?,donor_email=?,donor_contact=?,donationDate=? where donor_id=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
         
      }else{
         mysqli_stmt_bind_param($stmt, 'issssssssi', $reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date,$donorid);
          mysqli_stmt_execute($stmt);
     }
 
     
    

    

      mysqli_stmt_close($stmt);
      mysqli_close($conn);
   
       
    }

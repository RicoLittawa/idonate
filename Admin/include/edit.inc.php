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
      $Category= $_POST['category_arr'];
      $Contact= $_POST['contact'];
      $ItemName= $_POST['itemName_arr'];
      $Quantity= $_POST['quantity'];
      $Variant= $_POST['variant'];
      
    
      $sql ="UPDATE donation_items set Reference=?,donor_name=?,donor_region=?,donor_province=?,donor_municipality=?,donor_barangay=?,donor_email=?,donor_contact=?,donationDate=? where donor_id=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
         
      }else{
         mysqli_stmt_bind_param($stmt, 'issssssssi', $reference_id,$Fname,$Region,$Province,$Municipality,$Barangay,$Email,$Contact,$Date,$donorid);
          mysqli_stmt_execute($stmt);
     }
 
       $delvarTotal ="DELETE from categ_varianttotal where donor_reference= $reference_id";
       if ($conn->query($delvarTotal) === TRUE) {
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
     

       }else{
        echo "Error deleting record: " . $conn->error;
       }
    
     
       $sql1="DELETE from donation_items10 where Reference = $reference_id";
       if ($conn->query($sql1) === TRUE) {

          $count = 0;
          $resultCount = 0;
          foreach($Category as $item){

              $sql2= "INSERT INTO donation_items10 (Reference,category,name_items,variantCode) Values (?,?,?,?)";
              $stmt=mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt,$sql2)){
                
              }
              else{
                  mysqli_stmt_bind_param($stmt, 'ssss', $reference_id,$item,  $ItemName[$count],$Variant);
                  $result = mysqli_stmt_execute($stmt);
                  if($result) {
                      $resultCount = $resultCount + 1;
                      $count=$count+1;
                  }else {
                    echo 'Data not updated';
                  }
              }
          }
         echo "Data-updated";
    
    
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      


    

      mysqli_stmt_close($stmt);
      mysqli_close($conn);
   
       
    }

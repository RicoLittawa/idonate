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
      $Contact= $_POST['contact'];
      $ItemName= $_POST['itemName_arr'];
      $ItemsQuanti= $_POST['items_arr'];
      $TotalItems= $_POST['totalItem'];
        
      
    
      $sql ="UPDATE donation_items set Reference=?,donor_name=?,donor_province=?,donor_street=?,donor_region=?,donor_email=?,donor_contact=?,donationDate=? where donor_id=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
         
      }else{
         mysqli_stmt_bind_param($stmt, 'isssssssi', $reference_id,$Fname,$Province,$Street,$Region,$Email,$Contact,$Date,$donorid);
          mysqli_stmt_execute($stmt);
          
     }
     $sql1="DELETE from donation_items10 where Reference = $reference_id";
     if ($conn->query($sql1) === TRUE) {
        $count = 0;
        $resultCount = 0;
        foreach($Category as $item){

            $sql2= "INSERT INTO donation_items10 (Reference,category,name_items,variant,quantity,Items,total_items) Values (?,?,?,?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
                
            }
            else{
                mysqli_stmt_bind_param($stmt, 'sssssss', $reference_id, $item, $ItemName[$count], $Variant[$count], $Quantity[$count],$ItemsQuanti[$count],$TotalItems[$count]);
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

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
        
      
    
      $sql ="UPDATE donation_items set Reference=?,donor_name=?,donor_province=?,donor_street=?,donor_region=?,donor_email=?,donationDate=? where donor_id=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
         
      }else{
         mysqli_stmt_bind_param($stmt, 'issssssi', $reference_id,$Fname,$Province,$Street,$Region,$Email,$Date,$donorid);
          mysqli_stmt_execute($stmt);
          
     }
     $sql1="DELETE from donation_items10 where Reference = $reference_id";
     if ($conn->query($sql1) === TRUE) {
        $count = 0;
        $resultCount = 0;
        foreach($Category as $item){

            $sql2= "INSERT INTO donation_items10 (Reference,category,variant,quantity) Values (?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
                
            }
            else{
                mysqli_stmt_bind_param($stmt, 'ssss', $reference_id, $item, $Variant[$count], $Quantity[$count]);
                $result = mysqli_stmt_execute($stmt);
                if($result) {
                    $resultCount = $resultCount + 1;
                    $count=$count+1;
                }else {
   
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
          
     }$data =[
        'status' => 422,
        'message' => 'Data has been updated'
    ];
    echo json_encode($data);
    return false;
    
    
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      
     
     
    

      mysqli_stmt_close($stmt);
      mysqli_close($conn);
   
       
    }

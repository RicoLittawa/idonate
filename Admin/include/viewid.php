<?php 
require_once 'connection.php';
//view valid id
if (isset($_GET['viewID'])){
   $request_id= $_GET['viewID'];
   $sql= "SELECT valid_id from set_request where request_id=?";
   $stmt = $conn->prepare($sql); 
   $stmt->bind_param("i", $request_id);
   $stmt->execute();
   $result = $stmt->get_result();

    if ( $donor = $result->fetch_assoc()){
     
            echo $donor['valid_id'];
       
    }else{
        echo 'Data not found';
    }
    

}
//view message
if (isset($_GET['viewNote'])){
    $request_id= $_GET['viewNote'];
    $sql= "SELECT req_note from set_request where request_id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
 
     if ( $donor = $result->fetch_assoc()){
      
             echo $donor['req_note'];
        
     }else{
         echo 'Data not found';
     }
     
 
 }

 //accept request
 if (isset($_POST['acceptBtn'])){
    $request_id= $_POST['request_id'];
    $reference_id= $_POST['reference_id'];
    $req_name= $_POST['req_name'];
    $req_province= $_POST['req_province'];
    $req_street= $_POST['req_street'];
    $req_region= $_POST['req_region'];
    $req_email= $_POST['req_email'];
    $req_date= date('Y-m-d', strtotime($_POST['req_date']));
    $Category= $_POST['category_arr'];
    $Variant= $_POST['variant_arr'];
    $Quantity= $_POST['quantity_arr'];
    $donateRefId= $_POST['donateRefId'];
    $req_contact= $_POST['req_contact'];
    


    $sql1 = "INSERT INTO donation_items (Reference,donor_name,donor_province,donor_street,donor_region,donor_email,donor_contact,donationDate)
        VALUES (?,?,?,?,?,?,?,?)" ;
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql1)){
           echo'Sql error';
            exit();
          
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssssssss",$donateRefId,$req_name,$req_province,$req_street,$req_region,$req_email,$req_contact,$req_date);
            mysqli_stmt_execute($stmt);
        }
        $count = 0;
        $resultCount = 0;
        foreach($Category as $item){
            $sql2= "INSERT INTO donation_items10 (Reference,category,variant,quantity) Values (?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql2)){
                
            }
            else{
                mysqli_stmt_bind_param($stmt, 'ssss', $donateRefId, $item, $Variant[$count], $Quantity[$count]);
                $result = mysqli_stmt_execute($stmt);
                if($result) {
                    $resultCount = $resultCount + 1;
                    $count=$count+1;
                }
            }
        }
       
        
        $donateRefId=$donateRefId+1;
       $sql3="UPDATE donation_items_picking  set reference_id=? "; 
       $stmt=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt,$sql3)){
        
    } else{
        mysqli_stmt_bind_param($stmt, 'i', $donateRefId);
        $result2= mysqli_stmt_execute($stmt);
        if ($result2){
            
            
            $sql4= "DELETE from set_request where request_id= $request_id";
            if ($conn->query($sql4) === TRUE) {
                $valid_id = $_POST['valid_id'];
                $validPath= '../../donors/ValidId/'.$valid_id;
                unlink($validPath);
                
              } else {
                echo "Error deleting record: " . $conn->error;
              }
            $sql5="DELETE from set_request10 where req_reference = $reference_id";
            if ($conn->query($sql5) === TRUE) {
                
              } else {
                echo "Error deleting record: " . $conn->error;
              }
        }echo 'Data-submitted';
    }










    
 }
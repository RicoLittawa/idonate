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
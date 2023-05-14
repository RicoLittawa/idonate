<?php 
require_once '../../../config/config.php';
$sql= "SELECT * FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID);
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $lastname=  $row['lastname'];
     $position=  $row['position'];
     $email=  $row['email'];
     $address=  $row['address'];
     $profile=  $row['profile'];
     $role=  $row['role'];
     

    }
  }

}
catch(Exception $e){
  echo "Error". $e->getMessage();
}
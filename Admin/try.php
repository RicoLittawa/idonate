<?php 

include 'include/connection.php';
 $sql = "SELECT * from total_funds";
 $result= mysqli_query($conn,$sql);
 foreach ($result as $row){
    $amount= $row['amount'];
    $id= $row['id'];
 }


 $data= $amount+ 100;
echo $data;
 $addNew= "UPDATE total_funds set amount=? where id= ?";
 $stmt= $conn->prepare($addNew);
 $stmt->bind_param('is',$data,$id);
 $stmt->execute();
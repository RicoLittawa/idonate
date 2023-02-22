<?php 
require_once 'connection.php';
if(isset($_POST['submitBtn'])){
   $fname= $_POST['fname'];
   $lname= $_POST['lname'];
   $position= $_POST['position'];
   $email= $_POST['email'];
   $password= $_POST['password'];
   $address= $_POST['address'];
   $selectedValue= $_POST['selectedValue'];

   $sql= 'INSERT into adduser (firstname,lastname,position,email,pwdUsers,address,role) VALUES(?,?,?,?,?,?,?)';
   $stmt= $conn->prepare($sql);
   $hashPW= password_hash($password, PASSWORD_DEFAULT);
   $stmt->bind_param('sssssss', $fname,$lname,$position,$email,$hashPW,$address,$selectedValue);
   $stmt->execute();
   echo 'success';
}
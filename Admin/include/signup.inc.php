<?php 
include ('connection.php');

if (isset($_POST['signup-submit'])){
    $Email= $_POST['email'];
    $Password= $_POST['pwd'];
    $ConfirmPass= $_POST['pwd-repeat'];
    $sql = "INSERT INTO admindata (email,password,confirmPassword)
     VALUES ('$Email','$Password','$ConfirmPass')";
     $result= mysqli_query($conn,$sql) ;
     if ($result){
        echo "data inserted successfully";

     }
}
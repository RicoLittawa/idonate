<?php 
include '../include/connection.php';
if (isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql ="DELETE FROM items WHERE id=$id";
    $result= mysqli_query($conn,$sql);
    if ($result){
        header("Location: ../donations.php");
    }
    else{
        die(mysqli_error($conn));
    }
}

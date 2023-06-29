<?php 
require_once "../../../config/config.php";
if (isset($_POST["deleteBtn"])){
    $notifID= $_POST["notifID"];
    $delete = $conn->prepare("DELETE from notification where id= ?");
    $delete->bind_param("i",$notifID);
    $result= $delete->execute();
    if ($result){
        echo "deleted";
    }else{
        "error";
    }
}

if (isset($_POST["deleteAll"])){
    $userID= $_POST["userID"];
    $delete = $conn->prepare("DELETE from notification where userID= ?");
    $delete->bind_param("i",$userID);
    $result= $delete->execute();
    if ($result){
        echo "deleted";
    }else{
        "error";
    }
}

if (isset($_POST["deleteAdminBtn"])){
    $notifID= $_POST["notifID"];
    $delete = $conn->prepare("DELETE from admin_notification where id= ?");
    $delete->bind_param("i",$notifID);
    $result= $delete->execute();
    if ($result){
        echo "deleted";
    }else{
        "error";
    }
}

if (isset($_POST["deleteAllAdminBtn"])){
    $delete = $conn->prepare("DELETE from admin_notification");
    $result= $delete->execute();
    if ($result){
        echo "deleted";
    }else{
        "error";
    }
}
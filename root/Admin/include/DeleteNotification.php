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
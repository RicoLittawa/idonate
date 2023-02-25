<?php 
require_once 'connection.php';
if (isset($_POST['updateBtn'])){
    $uID = $_POST["uID"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $position = $_POST["position"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $Image = $_FILES['profileImg']['name'];
    $filePath='profile/';
    $filename=  $filePath.basename($_FILES['profileImg']['name']);
    $filetype=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $fileSize = $_FILES['profileImg']['size'];
    $fileError = $_FILES['profileImg']['error'];
    if(move_uploaded_file($_FILES['profileImg']['tmp_name'],$filePath.$Image)){
        if($fileError === 0){
            if($fileSize < 1000000) {
                $sql= "UPDATE adduser set firstname=?,lastname=?,position=?,email=?,address=?,profile=? where uID=?";
                $stmt= $conn->prepare($sql);
                try{
                    if(!$stmt){
                        throw new Exception('There was a problem executing the query.');
                    }
                    else{
                        $stmt->bind_param("ssssssi",$fname,$lname,$position,$email,$address,$Image,$uID);
                        if(!$stmt->execute()){
                            throw new Exception('There was a problem executing the query.');
                        }
                    }
                }
                catch(Exception $e){
                    echo "Error:".$e->getMessage();
                }


            }
        }
    }


  
}

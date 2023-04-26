<?php 
require_once 'connection.php';

 //upload certi template
 if (isset($_POST['upload'])){
    $imgID = $_POST['tempId'];
    $id = $_POST['id'];
    $selectImg= "SELECT template from template_certi where id=?";
    $stmt=$conn->prepare($selectImg);
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $result= $stmt->get_result();
    $img = $result->fetch_assoc();
     $imgGet= $img['template'];
    $validPath= '../include/Certificate Template/'.$imgGet;
    unlink($validPath);
    $Image = $_FILES['customFile']['name'];
    $filePath='Certificate Template/';
    $filename=  $filePath.basename($_FILES['customFile']['name']);
    $filetype=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $fileSize = $_FILES['customFile']['size'];
    $fileError = $_FILES['customFile']['error'];
        if(move_uploaded_file($_FILES['customFile']['tmp_name'],$filePath.$Image)){
         if($fileError === 0){
             if($fileSize < 1000000) {
                $template= "UPDATE template_certi set template=?";
                $stmt=$conn->prepare($template);
                $stmt->bind_param('s',$Image);
                $stmt->execute();
                echo "uploaded";
                 
             }
         }
        
        }
 }

  //view template certi
if (isset($_GET['viewTemp'])){
    $id= $_GET['viewTemp'];
    $sql= "SELECT template from template_certi where id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
 
     if ( $temp = $result->fetch_assoc()){
      
             echo $temp['template'];
        
     }else{
         echo 'Data not found';
     }
     
 
 }



 //update announcement
 if (isset($_GET['updateAnnounce'])){
    $id = $_GET['updateAnnounce'];
    $announce= $_POST['announce'];
    $sql= "UPDATE announcement_template set announcement=? where id=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param('si',$announce,$id);
    $result = $stmt->execute();
    if ($result){
        echo "Announcement updated";
    }
    else{
        echo "Changes not save";
    }
 }

<?php
require_once '../../../../config/config.php';

if (isset($_GET['templateId'])){
    $id= $_GET['id'];
    $cert= $conn->prepare("SELECT template from template_certi where id=?");
    $cert->bind_param('i',$id);
    $cert->execute();
    $result= $cert->get_result();
    try{
        if($result->num_rows == 0) {
            throw new Exception("Template not found.");
        }else{
            $row= $result->fetch_assoc();
            $template= $row['template'];
            echo $template;
        }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }


}
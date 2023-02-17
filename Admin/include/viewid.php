<?php 
require_once 'connection.php';
//view valid id
if (isset($_GET['viewID'])){
   $request_id= $_GET['viewID'];
   $sql= "SELECT valid_id from set_request where request_id=?";
   $stmt = $conn->prepare($sql); 
   $stmt->bind_param("i", $request_id);
   $stmt->execute();
   $result = $stmt->get_result();

    if ( $donor = $result->fetch_assoc()){
     
            echo $donor['valid_id'];
       
    }else{
        echo 'Data not found';
    }
    

}
//view message
if (isset($_GET['viewNote'])){
    $request_id= $_GET['viewNote'];
    $sql= "SELECT req_note from set_request where request_id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
 
     if ( $donor = $result->fetch_assoc()){
      
             echo $donor['req_note'];
        
     }else{
         echo 'Data not found';
     }
     
 
 }

 //view reference
 if (isset($_GET['money_id'])){
    $request_id= $_GET['money_id'];
    $sql= "SELECT money_img from monetary_donations where money_id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
 
     if ( $donor = $result->fetch_assoc()){
      
             echo $donor['money_img'];
        
     }else{
         echo 'Data not found';
     }
     
 
 }
 

 //view certificate
 if (isset($_GET['viewCert'])){
    $id= $_GET['viewCert'];
    $message='';
    $sql= "SELECT certificate from donation_items where donor_id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
 
     if ( $donor = $result->fetch_assoc()){
      
             echo $donor['certificate'];
        
     }else{
         echo 'Data not found';
     }
     
 
 }

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

 if(isset($_GET["term"])){
    $search= "%".$_GET['term']."%";
    $autoS= 'SELECT * from categ_products WHERE product_name LIKE ?';
    $stmt= $conn->prepare($autoS);
    $stmt->bind_param('s',$search);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $output= array();
    foreach ($data as $row){
        $temp_array=array();
        $temp_array['value']=$row['product_name'];
        $temp_array['label'] =$row['product_name'];

        $output[]= $temp_array;
    }
    echo json_encode($output);
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

 //delete item donor
 if (isset($_GET['deleteBtn'])){
    $id = $_GET['deleteBtn'];
    $selectImg= "SELECT rD_certificate from donor_record where rD_reference=?";
    $stmt=$conn->prepare($selectImg);
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $result= $stmt->get_result();
    $donor = $result->fetch_assoc();
    $cert= $donor['rD_certificate'];
    $validPath= '../include/download-certificate/'.$cert;
    unlink($validPath);
    
    $donor10= "DELETE from donation_items10 where Reference=?";
    $stmt= $conn->prepare($donor10);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();

    $donorTotal= "DELETE from categ_varianttotal where donor_reference=?";
    $stmt= $conn->prepare($donorTotal);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();

    $donorI = "DELETE from donor_record where rD_reference=?";
    $stmt= $conn->prepare($donorI);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();
    if ($result== true){
       
        echo "Data is deleted";
    }else{
        echo "Data is not deleted";
    }

 }
 
 //delete request
 if (isset($_GET['deleteReq'])){
    $id = $_GET['deleteReq'];
    $selectImg= "SELECT valid_id from set_request where reference_id=?";
    $stmt=$conn->prepare($selectImg);
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $result= $stmt->get_result();
    $donor = $result->fetch_assoc();
    $cert= $donor['rDM_certificate'];
    $validPath= '../../donors/ValidId/'.$cert;
    unlink($validPath);
    $donorReqTotal = "DELETE from req_varianttotal where req_reference=?";
    $stmt= $conn->prepare($donorReqTotal);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();

    $donorReq10 = "DELETE from set_request10 where req_reference=?";
    $stmt= $conn->prepare($donorReq10);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();

    
    $donorReq = "DELETE from set_request where reference_id=?";
    $stmt= $conn->prepare($donorReq);
    $stmt->bind_param('i',$id);
    $result= $stmt-> execute();
    if ($result== true){
       
        echo "Data is deleted";
    }else{
        echo "Data is not deleted";
    }

 }
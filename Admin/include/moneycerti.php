<?php 
    use PHPMailer\PHPMailer\PHPMailer;
  
    //send certi moneytable
if(isset($_POST['money_data'])){
  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';
  require 'fpdf/fpdf.php';
  require_once 'connection.php';
  $output= '';
  foreach($_POST['money_data']as $row)
  {
   
    $image= imagecreatefrompng('Certificate Template/certificate2.png');
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $font="fonts/Roboto-Black.ttf";
    $size =110;
    $box = imagettfbbox($size, 0, $font, $row['name']);
    $text_width = abs($box[2]) - abs($box[0]);
    $text_height = abs($box[5]) - abs($box[3]);
    $image_width = imagesx($image);
    $image_height = imagesy($image);
    $x = ($image_width - $text_width) / 2;
    $y = ($image_height + $text_height) / 2;

// add text
    imagettftext($image, $size, 0, $x, $y, $black,$font, $row['name']);
  
   
    
    $file=time();
    $genImage= $row['name'].$file.'.png';
    
   
    $file_path="money_donor/".$row['name'].$file.".png";
    $file_path_pdf= "money_donor/".$row['name'].$file.".pdf";

    
    imagepng($image,$file_path);
    imagedestroy($image);
    $pdf= new FPDF();   
    $pdf->AddPage('L','A5');
   $pdf->Image($file_path,0,0,210,150);

     $money_id= $row['uID'];
     $sql= "SELECT * from monetary_donations where money_id=?";
     $stmt= $conn->prepare($sql);
     $stmt-> bind_param('i',$money_id);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $user = $result->fetch_assoc(); 

    $rdm_name= $user['money_name'];
    $rdm_province= $user['money_province'];
    $rdm_street= $user['money_street'];
    $rdm_region= $user['money_region'];
    $rdm_email= $user['money_email'];
    $rdm_contact= $user['money_contact'];
    $amount= $user['money_amount'];
    $rdm_date= date('Y-m-d', strtotime($user['money_date']));
 

    $rdm_img= $user['money_img'];
    $validPath= '../../donors/ReferencePhoto/'.$rdm_img;
    unlink($validPath);

    $totalDonor="INSERT into total_donor(Tdonor_name) value(?)";
      $stmt=$conn->prepare($totalDonor);
      $stmt->bind_param('s',$rdm_name);
      $stmt->execute();
     $sql2= "INSERT into donor_recordm(rDM_name,rDM_province,rDM_street,rDM_region,rDM_contact,rDM_email,rDM_date,donated,rDM_certificate)
      value (?,?,?,?,?,?,?,?,?)";
     $stmt=$conn->prepare($sql2);
     $stmt->bind_param('sssssssss',$rdm_name,$rdm_province,$rdm_street,$rdm_region,$rdm_contact,$rdm_contact,$rdm_date,$amount, $genImage);
     $result= $stmt->execute();
    
    

     if($result){
     $newAmount= "SELECT * from total_funds";
     $newResult= mysqli_query($conn,$newAmount);
     foreach ($newResult as $addFund){
      $addnewFund = $addFund['amount'];
      $fundID= $addFund['id'];
     }
     $combFund= $amount+$addnewFund;
     $addNew= "UPDATE total_funds set amount=? where id= ?";
     $stmt= $conn->prepare($addNew);
     $stmt->bind_param('is',$combFund,$fundID);
     $stmt->execute();


      $mail = new PHPMailer;
      $mail->IsSMTP();        //Sets Mailer to send message using SMTP
      $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
      $mail->Port = '465';        //Sets the default SMTP server port
      $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
      $mail->Username = 'testcdrrmo@gmail.com';     //Sets SMTP username
      $mail->Password = 'mlytxekfgplnhsap';     //Sets SMTP password
      $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
      $mail->From = 'testcdrrmo@gmail.com';   //Sets the From email address for the message
      $mail->FromName = 'Code With Nevil'; 
      $mail->setFrom('testcdrrmo@gmail.com');    //Sets the From name of the message
      $mail->AddAddress($row["email"], $row["name"]); //Adds a "To" address
      $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);       //Sets message type to HTML
      $mail->Subject = 'Testing'; //Sets the Subject of the message
      //An HTML or plain text message body
      $mail->Body = '
      <p>Certificate...</p>
      ';
      $mail->addStringAttachment($pdf->Output("S",'AcknowledgementReciept.pdf'), 'AcknowledgementReciept.pdf', $encoding = 'base64', $type = 'application/pdf');
      $mail->Send();      //Send an Email. Return true on success or false on error

     $sql3 ="DELETE from monetary_donations where money_id = ?";
     $stmt= $conn->prepare($sql3);
     $stmt->bind_param('i',$money_id);
     $result2= $stmt->execute();
     if($result2){
      echo 'Inserted';

    }else{
      echo 'Something went wrong';
    }
  

     }
   
     else{
      echo 'error';
     }
    
 
  
 }

}




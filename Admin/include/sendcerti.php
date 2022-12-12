<?php 
   
    use PHPMailer\PHPMailer\PHPMailer;
  
   
 if(isset($_POST['email_data'])){
  require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';
   require 'fpdf/fpdf.php';
   require_once 'connection.php';
  
  

  foreach($_POST['email_data']as $row)
  {
   $template= "SELECT * from template_certi";
   $result = mysqli_query($conn,$template);
   foreach($result as $rowTemp){
   $tempCert= $rowTemp['template'];
   } 
    $image= imagecreatefrompng('Certificate Template/'.$tempCert);
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
    $file_path="download-certificate/".$row['name'].$file.".png";
    $file_path_pdf= "download-certificate/".$row['name'].$file.".pdf";
    
    imagepng($image,$file_path);
    imagedestroy($image);

    $pdf= new FPDF();   
    $pdf->AddPage('L','A5');
   $pdf->Image($file_path,0,0,210,150);
   $donor_id= $row['uID'];


  
     $sql= "SELECT * from donation_items where donor_id=?";
     $stmt= $conn->prepare($sql);
     $stmt-> bind_param('i',$donor_id);
     $stmt->execute();
     $result = $stmt->get_result(); 
     $user = $result->fetch_assoc(); 

    $rd_name= $user['donor_name'];
    $rd_reference= $user['Reference'];
    $rd_province= $user['donor_province'];
    $rd_municipality= $user['donor_municipality'];
    $rd_barangay= $user['donor_barangay'];
    $rd_region= $user['donor_region'];
    $rd_email= $user['donor_email'];
    $rd_contact= $user['donor_contact'];
    $rd_date= date('Y-m-d', strtotime($user['donationDate']));
    

      $totalDonor="INSERT into total_donor(Tdonor_name) value(?)";
      $stmt=$conn->prepare($totalDonor);
      $stmt->bind_param('s',$rd_name);
      $stmt->execute();

     $sql2= "INSERT into donor_record(rD_reference,rD_name,rD_region,rD_province,rD_municipality,rD_barangay,rD_email,rD_contact,rD_date,rd_certificate)
      value (?,?,?,?,?,?,?,?,?,?)";
     $stmt=$conn->prepare($sql2);
     $stmt->bind_param('ssssssssss',$rd_reference,$rd_name,$rd_region,$rd_province,$rd_municipality,$rd_barangay,$rd_email,$rd_contact,$rd_date,  $genImage);
     $result= $stmt->execute();

     if($result){
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
      $mail->Subject = 'Acknowledgement Reciept'; //Sets the Subject of the message
      //An HTML or plain text message body
      $donatedItems = "SELECT * FROM donation_items10 WHERE Reference=?";
					$stmt = $conn->prepare($donatedItems); 
					$stmt->bind_param("s", $rd_reference);
					$stmt->execute();
					$itemResult = $stmt->get_result();
					$data = [];
					
					$data = $itemResult->fetch_all(MYSQLI_ASSOC);
					
					if($data){
			 $itemName= [];
       $count=0;
			foreach($data as $items){
        $count++;
        $message='';
				$itemName= $items['name_items'];
				
				
       $message.='
        <p>Thank you for donating a '.$itemName.' This acknowledgement reciept is created as a sign of gratitude for your kindness.</p>
        ';
       }
        }
			 $mail->Body = $message; 
  
      $mail->addStringAttachment($pdf->Output("S",'AcknowledgementReciept.pdf'), 'AcknowledgementReciept.pdf', $encoding = 'base64', $type = 'application/pdf');
      $mail->Send();      //Send an Email. Return true on success or false on error

     $sql3 ="DELETE from donation_items where donor_id = ?";
     $stmt= $conn->prepare($sql3);
     $stmt->bind_param('i',$donor_id);
     $result1= $stmt->execute();
    if($result1){
      echo 'Inserted';

    }else{
      echo 'Something went wrong';
    }

     }else{
      echo 'error';
     }
    
 
  
 }
 
}





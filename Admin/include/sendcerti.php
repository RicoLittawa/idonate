<?php 
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
  
   
 if(isset($_POST['email_data'])){
  require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';
   require 'fpdf/fpdf.php';
   require 'connection.php';

  $output='';
  foreach($_POST['email_data']as $row)
  {
    $image= imagecreatefrompng('D:/App Projects/Source/idonate/Admin/include/Certificate Template/certificate2.png');
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $font="D:/App Projects/Source/idonate/Admin/fonts/Roboto-Black.ttf";
    $size =110;
    $box = imagettfbbox($size, 0, $font, $row['donor_name']);
    $text_width = abs($box[2]) - abs($box[0]);
    $text_height = abs($box[5]) - abs($box[3]);
    $image_width = imagesx($image);
    $image_height = imagesy($image);
    $x = ($image_width - $text_width) / 2;
    $y = ($image_height + $text_height) / 2;

// add text
    imagettftext($image, $size, 0, $x, $y, $black,$font, $row['donor_name']);
  
   
    
    $file=time();
    $file_path="download-certificate/".$file.".png";
    $file_path_pdf= "download-certificate/".$file.".pdf";
    
    imagepng($image,$file_path);
    imagedestroy($image);

    $pdf= new FPDF();   
    $pdf->AddPage('L','A5');
    $pdf->Image($file_path,0,0,210,150);
    $mail=new PHPMailer;
    $mail->isSMTP();
     $mail->Host= 'smtp.gmail.com';
     $mail->SMTPAuth= true;
     $mail->Username='testcdrrmo@gmail.com' ;
     $mail->Password= 'mlytxekfgplnhsap';
     $mail->SMTPSecure='ssl';
     $mail->Port=465;
   
     $mail->setFrom('testcdrrmo@gmail.com');
     $mail->addAddress($row['donor_email'],$row['donor_name']);
     $mail->isHTML(true);
     $mail->Subject= "Certificate";
     $mail->Body= "This is certificate";
     $mail->addStringAttachment($pdf->Output("S",'AcknowledgementReciept.pdf'), 'AcknowledgementReciept.pdf', $encoding = 'base64', $type = 'application/pdf');
     $mail->AltBody='';
     $mail->Send();
             
} if($output==''){
  echo 'ok';
  }else{
    echo $output;
  }
            
 }

 

  




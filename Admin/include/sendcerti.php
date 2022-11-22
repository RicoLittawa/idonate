<?php 
   
    use PHPMailer\PHPMailer\PHPMailer;
  
   
 if(isset($_POST['email_data'])){
  require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';
   require 'fpdf/fpdf.php';
  
  
  $output= '';
  foreach($_POST['email_data']as $row)
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
    $file_path="download-certificate/".$file.".png";
    $file_path_pdf= "download-certificate/".$file.".pdf";
    
    imagepng($image,$file_path);
    imagedestroy($image);

    $pdf= new FPDF();   
    $pdf->AddPage('L','A5');
    $pdf->Image($file_path,0,0,210,150);
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


 }
 if($output == '')
 {
  echo 'ok';
 }
 else
 {
  echo $output;
 }
}
?>

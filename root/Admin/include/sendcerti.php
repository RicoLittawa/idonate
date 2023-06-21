<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'fpdf/fpdf.php';
require_once '../../../config/config.php';
if (isset($_POST['email_data'])) {
   try {
      $status = 'email_sent';
      $template =  $conn->prepare("SELECT * FROM template_certi");
      if (!$template) {
         throw new Exception("There was a problem connecting to the database");
      }
      $template->execute();
      $result = $template->get_result();
      $rowTemp = $result->fetch_assoc();
      $tempCert = $rowTemp['template'];
      foreach ($_POST['email_data'] as $row) {
         $donor_id = $row['uID'];

         $image = imagecreatefrompng('Certificate Template/' . $tempCert);
         $white = imagecolorallocate($image, 255, 255, 255);
         $black = imagecolorallocate($image, 0, 0, 0);
         $font = "fonts/Roboto-Black.ttf";
         $size = 110;
         $box = imagettfbbox($size, 0, $font, $row['name']);
         $text_width = abs($box[2]) - abs($box[0]);
         $text_height = abs($box[5]) - abs($box[3]);
         $image_width = imagesx($image);
         $image_height = imagesy($image);
         $x = ($image_width - $text_width) / 2;
         $y = ($image_height + $text_height) / 2;

         // add text
         imagettftext($image, $size, 0, $x, $y, $black, $font, $row['name']);

         $file = uniqid();
         $genImage = $row['name'] . '_' . $file . '.png';
         $file_path = "download-certificate/" . $row['name'] . '_' . $file . ".png";
         $file_path_pdf = "download-certificate/" . $row['name'] . '_' . $file . ".pdf";

         imagepng($image, $file_path);
         imagedestroy($image);

         $pdf = new FPDF();
         $pdf->AddPage('L', 'A5');
         $pdf->Image($file_path, 0, 0, 210, 150);
         $donor_id = $row['uID'];

         $mail = new PHPMailer;
         $mail->IsSMTP();        //Sets Mailer to send message using SMTP
         $mail->Host = 'smtp.hostinger.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
         $mail->Port = '465';        //Sets the default SMTP server port
         $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
         $mail->Username = SMTP_USERNAME;     //Sets SMTP username
         $mail->Password = SMTP_PASSWORD;     //Sets SMTP password
         $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
         $mail->setFrom('citydisasterriskreductionmanagementoffice@i-donate-btg.com', 'City Disaster Risk Reduction Management Office');
         $mail->AddAddress($row["email"], $row["name"]); //Adds a "To" address
         $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
         $mail->IsHTML(true);
         $greeting = "Dear Donor,";
         $content = "Here is the attached certificate of acknowledgement to show gratitude of kindness to our donors.";
         $thankYouMessage =
            "Thank you for donating. If you have any further questions, please feel free to contact us.";
         $mail->Subject = 'Acknowledgement Reciept'; //Sets the Subject of the message
         //An HTML or plain text message body
         $mail->Body = "
         <html>
             <body>
                 <p>{$greeting}</p>
                 <p>{$content}</p>
                 <p>{$thankYouMessage}</p>
                 <br>
                 <p>Best regards,</p>
                 <p>City Disaster Risk Reduction Management Office</p>
                 <p>Brgy Bolbok, Batangas City, Philippines</p>
                 <p>cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
             </body>
         </html>
     ";
         $mail->addStringAttachment($pdf->Output("S", 'AcknowledgementReciept.pdf'), 'AcknowledgementReciept.pdf', $encoding = 'base64', $type = 'application/pdf');
         $mail->Send();

         $updateEmailStatus = $conn->prepare("UPDATE donation_items set email_status=?, certificate=? where donor_id=?");
         if (!$updateEmailStatus) {
            throw new Exception("There was a problem connecting to the database");
         } else {
            $updateEmailStatus->bind_param('ssi', $status, $genImage, $donor_id);
            $updateEmailStatus->execute();
            $response = [
               "status" => "Success",
               "message" => "Email has been sent successfully",
               "icon" => "success",
            ];

            header("Content-Type: application/json");
            echo json_encode($response);
            exit();
         }
      }
   } catch (Exception $e) {
      $response = [
         "status" => "Error",
         "message" => $e->getMessage(),
         "icon" => "error",
      ];

      header("Content-Type: application/json");
      echo json_encode($response);
      exit();
   }
}

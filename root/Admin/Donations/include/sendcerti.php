<?php
require_once '../../../../config/config.php';
include '../../include/ResponseMessages.php';

use PHPMailer\PHPMailer\PHPMailer;

require '../../include/phpmailer/src/Exception.php';
require '../../include/phpmailer/src/PHPMailer.php';
require '../../include/phpmailer/src/SMTP.php';
require '../../include/fpdf/fpdf.php';

if (isset($_POST['email_data'])) {
   $emailData = $_POST['email_data'];
   $status = 'email_sent';
   $template =  $conn->prepare("SELECT * FROM template_certi");
   if (!$template) {
      errorMessage("There was a problem connecting to the database." . $conn->error);
   }
   $template->execute();
   $result = $template->get_result();
   $rowTemp = $result->fetch_assoc();
   $tempCert = $rowTemp['template'];
   foreach ($emailData as $row) {
      $donor_id = $row['uID'];
      $name = $row['name'];
      $email = $row["email"];
      $image = imagecreatefrompng('../../include/Certificate Template/' . $tempCert);
      $white = imagecolorallocate($image, 255, 255, 255);
      $black = imagecolorallocate($image, 0, 0, 0);
      $font = "../../include/fonts/Roboto-Black.ttf";
      $size = 110;
      $box = imagettfbbox($size, 0, $font, $name);
      $text_width = abs($box[2]) - abs($box[0]);
      $text_height = abs($box[5]) - abs($box[5]);
      $image_width = imagesx($image);
      $image_height = imagesy($image);
      $x = ($image_width - $text_width) / 2;
      $y = ($image_height + $text_height) / 2.25;
      // add text
      imagettftext($image, $size, 0, $x, $y, $black, $font, $name);
      $file = uniqid();
      $genImage = $name . '_' . $file . '.png';
      $file_path = "../../include/download-certificate/" . $name . '_' . $file . ".png";
      $file_path_pdf = "../../include/download-certificate/" . $name . '_' . $file . ".pdf";
      imagepng($image, $file_path);
      imagedestroy($image);
      $pdf = new FPDF();
      $pdf->AddPage('L', 'A5');
      $pdf->Image($file_path, 0, 0, 210, 150);
      //Send acknowledgement receipt through email
      $greeting = "Dear Donor,";
      $content = "Here is the attached certificate of acknowledgement to show gratitude of kindness to our donors.";
      $thankYouMessage =
         "Thank you for donating. If you have any further questions, please feel free to contact us.";
      $mail = new PHPMailer(true);

      // Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = SMTP_USERNAME;                     // SMTP username
      $mail->Password   = SMTP_PASSWORD;                               // SMTP password
      $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      // Recipients
      $mail->setFrom('citydisasterriskreductionmanagementoffice@i-donate-btg.com', 'City Disaster Risk and Reduction Management Office');
      $mail->addAddress($email);     // Add a recipient

      // Content
      $mail->isHTML(true);
      $greeting = "Dear New User";
      $content = "Your account has been created successfully. You can use the email and password to login to the system.";
      $mail->Subject = 'Acknowledgement Reciept';
      $mail->Body = "
          <html>
              <body>
                  <p>{$greeting}</p>
                  <p>{$content}</p>
                  <p>{$thankYouMessage}</p>
                  <br>
                  <p>Best regards,</p>
                  <p>City Disaster Risk and Reduction Management Office</p>
                  <p>Brgy Bolbok, Batangas City, Philippines</p>
                  <p>cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
              </body>
          </html>
      ";
      $mail->addStringAttachment($pdf->Output("S", 'AcknowledgementReciept.pdf'), 'AcknowledgementReciept.pdf', $encoding = 'base64', $type = 'application/pdf');
      $mail->send();

      $updateEmailStatus = $conn->prepare("UPDATE donation_items set email_status=?, certificate=? where donor_id=?");
      if (!$updateEmailStatus) {
         errorMessage("There was a problem connecting to the database" . $conn->error);
      } else {
         $updateEmailStatus->bind_param('ssi', $status, $genImage, $donor_id);
         $updateEmailStatus->execute();
         successMessage("Email has been sent successfully.");
      }
   }
}

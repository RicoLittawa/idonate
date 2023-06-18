<?php
require_once "../../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;

require "../Admin/include/phpmailer/src/Exception.php";
require "../Admin/include/phpmailer/src/PHPMailer.php";
require "../Admin/include/phpmailer/src/SMTP.php";
if (isset($_POST["submitBtn"])){
    echo "workking";
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // SMTP server address
$mail->SMTPAuth = true;
$mail->Username = SMTP_USERNAME;  // Your SMTP username
$mail->Password = SMTP_PASSWORD;  // Your SMTP password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom($email);
$mail->addAddress('ricolittawa030620@gmail.com');  // Your email address
$mail->Subject = 'Contact Form Submission';
$mail->Body = $message;  // Assuming the message is submitted through a form field
$mail->send();

    

  
}
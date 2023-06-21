<?php
require_once "../../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;

require "../Admin/include/phpmailer/src/Exception.php";
require "../Admin/include/phpmailer/src/PHPMailer.php";
require "../Admin/include/phpmailer/src/SMTP.php";

if (isset($_POST["submitBtn"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $recaptchaResponse = $_POST["recaptchaResponse"]; // Get the reCAPTCHA response
    $secret_key = '6LddXa4mAAAAAKqUpy5fbcIbBdzv2uv-zeHtWHzu';
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptchaResponse}");
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        $response = [
            "status" => "Error",
            "message" => "reCAPTCHA verification failed.",
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
        exit();     
      }



    // Initialize PHPMailer
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = '465';
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = 'ssl';
    $mail->From = 'citydisasterriskreductionmanagementoffice@i-donate-btg.com'; // Set your forwarder email address
    $mail->FromName = 'City Disaster Risk Reduction Management Office';
    $mail->AddAddress('cdrrmoidonatebtg@gmail.com'); // Your own email address to receive the emails
    $mail->WordWrap = 50;
    $mail->IsHTML(true);

    // Compose the email
    $mail->Subject = 'New Contact Us Submission';
    $mail->Body = "
        <html>
            <head>
                <style>
                    a {
                        color: #007bff !important; /* Set the desired link color */
                        text-decoration: none !important; /* Remove the underline decoration */
                    }
                </style>
            </head>
            <body>
                <div style='text-align: start; width: 500px; margin: 0 auto; border: 1px solid #ccc; padding: 20px; border-radius:10px;'>
                    <p style='font-size: 18px; font-weight: bold;'>Contact Us Submissions</p>
                    <p style='font-size: 14px; margin-bottom:0;'>Name: <strong>{$name}</strong></p>
                    <p style='font-size: 14px; margin-bottom:0;'>Email: <strong>{$email}</strong></p>
                    <br>
                    <p style='font-size: 14px;'>Message: <strong>{$message}</strong></p>
                </div>
            </body>
        </html>
    ";

    // Send the email
    if ($mail->Send()) {
        $response = [
            "status" => "Success",
            "message" => "Thank you for contacting us.",
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    } else {
        $response = [
            "status" => "Error",
            "message" => "Error sending email: " . $mail->ErrorInfo,
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
    }
}

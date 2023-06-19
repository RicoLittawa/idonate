<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../include/phpmailer/src/Exception.php';
require '../../include/phpmailer/src/PHPMailer.php';
require '../../include/phpmailer/src/SMTP.php';
require_once '../../../../config/config.php';
if (isset($_POST['submitBtn'])) {
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $position = trim($_POST['position']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $address = trim($_POST['address']);
  $selectedValue = $_POST['selectedValue'];



  // Insert the new record
  $sql = 'INSERT INTO adduser (firstname, lastname, position, email, pwdUsers, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)';
  $stmt = $conn->prepare($sql);
  try {
    if (!$stmt) {
      throw new Exception('There was a problem connecting to the database');
    } else {
      $hashPW = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bind_param('sssssss', $fname, $lname, $position, $email, $hashPW, $address, $selectedValue);
      $result = $stmt->execute();
      if ($result) {
        // Send email
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
        $mail->setFrom('cityriskreductionoffice@i-donate-btg.com', 'City Risk Reduction Management Office');
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);
        $greeting = "Dear New User";
        $content = "Your account has been created successfully. You can use the email and password to login to the system.";
        $mail->Subject = 'Created Account';
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
            <div style='text-align: center; width: 500px; margin: 0 auto; border: 1px solid #ccc; padding: 20px; border-radius:10px;'>
                <p style='font-size: 18px; font-weight: bold;'>{$greeting}</p>
                <p style='font-size: 14px;'>{$content}</p>
                <a href='http://localhost:3000/root/Admin/login.php'>
                    <button style='background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 14px;'>Login</button>
                </a>
                <p style='font-size: 14px;'>Email: <strong>{$email}</strong></p>
                <p style='font-size: 14px;'>Password: <strong>{$_POST['password']}</strong></p>
                <br>
                <p style='font-size: 14px;'>Best regards,</p>
                <p style='font-size: 14px;'>City Risk Reduction Management Office</p>
                <p style='font-size: 14px;'>Brgy Bolbok, Batangas City, Philippines</p>
                <p style='font-size: 14px;'>cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
            </div>
        </body>
    </html>
";

        $mail->send();
        $response = [
          "status" => "Success",
          "message" => "New account has been successfully created",
          "icon" => "success",
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
        exit();
        $stmt->close();
      }
    }
  } catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
      // Handle duplicate email error
      $response = [
        "status" => "Error",
        "message" => "Email address already exist",
        "icon" => "error",
        "duplicate" => true
      ];

      header("Content-Type: application/json");
      echo json_encode($response);
      exit();

      echo "Email already exists";
    } else {
      // Handle other MySQL errors
      $response = [
        "status" => "Error",
        "message" => $e->getMessage(),
        "icon" => "error",
      ];

      header("Content-Type: application/json");
      echo json_encode($response);
      exit();
    }
  } catch (Exception $e) {
    // Handle other non-MySQL errors
    $response = [
      "status" => "Error",
      "message" => $e->getMessage(),
      "icon" => "error",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  } finally {
    $conn->close();
  }
}

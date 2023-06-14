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
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = SMTP_USERNAME;                     // SMTP username
        $mail->Password   = SMTP_PASSWORD;                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('testcdrrmo@gmail.com');
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);
        $greeting = "Dear New User";
        $content = "Your account has been created successfully. You can use the email and password to login to the system.";
        $thankYouMessage =
          "Thank you for using our service. If you have any further questions, please feel free to contact us.";
        $mail->Subject = 'Created Account';
        $mail->Body = "
        <html>
            <body>
                <p>{$greeting}</p>
                <p>{$content}</p>
                <p>Email: <strong>{$email}<strong></p>
                <p>Password: <strong>{$_POST['password']}</strong></p>
                <p>You can update your password after you login to the system</p>
                <p>{$thankYouMessage}</p>
                <br>
                <p>Best regards,</p>
                <p>City Risk Reduction Management Office</p>
                <p>Address: Brgy Bolbok, Batangas City, Philippines</p>
                <p>Contact Information: cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
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

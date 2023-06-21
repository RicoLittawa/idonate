<?php
require_once "../../../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

// Function to generate a random token
function generateToken($length = 6)
{
  $token = "";
  $characters = "0123456789";
  $max = strlen($characters) - 1;

  for ($i = 0; $i < $length; $i++) {
    $token .= $characters[rand(0, $max)];
  }

  return $token;
}

if (isset($_POST["sendBtn"])) {
  $email = $_POST["email"];

  // Check if the email exists in the database
  $stmt = $conn->prepare(
    "SELECT email, uID, reset_token_expiry FROM adduser WHERE email = ?"
  );
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    // Email address does not exist
    $response = [
      "status" => "Error",
      "message" => "Email address does not exist",
      "icon" => "error",
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  }

  $row = $result->fetch_assoc();
  $resetTokenExpiry = strtotime($row["reset_token_expiry"]);
  $currentTimestamp = time();

  // Check if there is a cooldown period in effect
  if ($currentTimestamp < $resetTokenExpiry) {
    $remainingTime = $resetTokenExpiry - $currentTimestamp;
    $minutes = floor($remainingTime / 60);
    $seconds = $remainingTime % 60;

    $response = [
      "status" => "Error",
      "message" => "Please wait {$minutes} minutes and {$seconds} seconds before sending another request",
      "remainingTime" => $remainingTime,
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  }

  // Generate a token
  $token = generateToken();
  $hashToken = password_hash($token, PASSWORD_DEFAULT);

  // Store the token and its expiry in the database
  $tokenExpiry = date("Y-m-d H:i:s", strtotime("+3 hours")); // Token expiry set to 30 minutes from now
  $updateToken = $conn->prepare(
    "UPDATE adduser SET reset_token = ?, reset_token_expiry = ? WHERE email = ?"
  );
  $updateToken->bind_param("sss", $hashToken, $tokenExpiry, $email);
  $updateToken->execute();

  // Send the reset email
  $resetLink =
    "http://localhost:3000/root/Admin/SentResetLink.php?token=" . $hashToken;
  $mail = new PHPMailer(true);

  // Server settings
  $mail->SMTPDebug = 0; // Enable verbose debug output
  $mail->isSMTP(); // Send using SMTP
  $mail->Host = "smtp.hostinger.com"; // Set the SMTP server to send through
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = SMTP_USERNAME; // SMTP username
  $mail->Password = SMTP_PASSWORD; // SMTP password
  $mail->SMTPSecure = "ssl"; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  // Recipients
  $mail->setFrom('cityriskreductionoffice@i-donate-btg.com', 'City Disaster Risk Reduction Management Office');
  $mail->addAddress($email); // Add a recipient

  // Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = "Password Reset";
  // Construct the email body
  $greeting = "Dear User,";
  $content =
    "We received a request to reset your password. You can use the following button to reset your password:";
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
                <a href='{$resetLink}'>
                    <button style='background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 14px;'>Reset Password</button>
                </a>
                <p style='font-size: 14px;'>You can copy the provided token to reset your password: <strong>{$token}</strong></p>
                <p style='font-size: 14px;'>If you don't use the token within 3 hours, it will expire. To get a new password reset link, visit: http://localhost:3000/root/Admin/PasswordReset.ph</p>
                <br>
                <p style='font-size: 14px;'>Best regards,</p>
                <p style='font-size: 14px;'>City Disaster Risk Reduction Management Office</p>
                <p style='font-size: 14px;'>Brgy Bolbok, Batangas City, Philippines</p>
                <p style='font-size: 14px;'>cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
            </div>
        </body>
    </html>
";

  try {
    $mail->send();
    $response = [
      "status" => "Success",
      "message" => "Check your email for a link to reset your password. 
      If it doesn’t appear within a few minutes, check your spam folder.",
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  } catch (Exception $e) {
    $response = [
      "status" => "Error",
      "message" =>
      "An error occurred while sending the reset email. Please try again later.",
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  }
}

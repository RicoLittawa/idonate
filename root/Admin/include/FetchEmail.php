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
      "message" => "Please wait {$minutes} minutes and {$seconds} seconds before sending another reset email",
      "icon" => "error",
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
  $tokenExpiry = date("Y-m-d H:i:s", strtotime("+30 minutes")); // Token expiry set to 30 minutes from now
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
  $mail->Host = "smtp.gmail.com"; // Set the SMTP server to send through
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = SMTP_USERNAME; // SMTP username
  $mail->Password = SMTP_PASSWORD; // SMTP password
  $mail->SMTPSecure = "ssl"; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  // Recipients
  $mail->setFrom("testcdrrmo@gmail.com");
  $mail->addAddress($email); // Add a recipient

  // Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = "Password Reset";
  // Construct the email body
  $greeting = "Dear User,";
  $content =
    "We received a request to reset your password. Please click the link below to proceed with the password reset process:";
  $thankYouMessage =
    "Thank you for using our service. If you have any further questions, please feel free to contact us.";
  $mail->Body = "
    <html>
        <body>
            <p>{$greeting}</p>
            <p>{$content}</p>
            <p><a href='{$resetLink}'>{$resetLink}</a></p>
            <p>You can copy the provided token to reset your password: {$token}</p>
            <p>{$thankYouMessage}</p>
            <br>
            <p>Best regards,</p>
            <p>City Risk Reduction Management Office</p>
            <p>Brgy Bolbok, Batangas City, Philippines</p>
            <p>cdrrmobatangas@yahoo.com.ph | (043) 702 3902</p>
        </body>
    </html>
";
  try {
    $mail->send();
    $maskedEmail =
      substr($email, 0, 2) .
      str_repeat("*", strlen($email) - 2) .
      substr($email, strpos($email, "@"));
    $response = [
      "status" => "Success",
      "message" => "Email has been sent to " . $maskedEmail,
      "icon" => "success",
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  } catch (Exception $e) {
    $response = [
      "status" => "Error",
      "message" =>
        "An error occurred while sending the reset email. Please try again later.",
      "icon" => "error",
    ];
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
  }
}

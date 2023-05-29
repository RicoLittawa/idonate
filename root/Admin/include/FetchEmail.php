<?php
require_once "../../../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
// Update/reset reset attempts
function updateResetAttempts($ipAddress, $userId)
{
    global $conn;

    // Prepare and execute query to update/reset reset attempts
    $stmt = $conn->prepare("INSERT INTO reset_attempts (ip_address, user_id, timestamp) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE attempt_count = attempt_count + 1, timestamp = NOW()");
    $stmt->bind_param("si", $ipAddress, $userId);
    $stmt->execute();
}

if (isset($_POST["sendBtn"])) {
    // Generate and store the token
    function generateToken($length = 6)
    {
        $token = '';
        $characters = '0123456789';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $max)];
        }

        return $token;
    }

    $email = $_POST["email"];
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
    $getEmail = $conn->prepare("SELECT email,uID FROM adduser WHERE email = ?");
    try {
        if (!$getEmail) {
            throw new Exception('There was a problem connecting to the database');
        } else {
            $getEmail->bind_param('s', $email);
            $getEmail->execute();
            $result = $getEmail->get_result();
            if ($result->num_rows === 0) {
                throw new Exception("Email address does not exist");
            } else {
                $row = $result->fetch_assoc();
                $uID = $row['uID'];
                $maxAttempts = 3;
                $resetDuration = '-1 minute';
                $resetTimeBoundary = date('Y-m-d H:i:s', strtotime($resetDuration));

                $stmt = $conn->prepare("SELECT COUNT(*) as attempt_count FROM reset_attempts WHERE ip_address = ? AND user_id = ? AND timestamp >= ?");
                $stmt->bind_param("sis", $ipAddress, $uID, $resetTimeBoundary);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $attemptCount = $row['attempt_count'];

                if ($attemptCount >= $maxAttempts) {
                    $lastAttemptTime = $conn->prepare("SELECT MAX(timestamp) as last_attempt_time FROM reset_attempts WHERE ip_address = ? AND user_id = ?");
                    $lastAttemptTime->bind_param("si", $ipAddress, $uID);
                    $lastAttemptTime->execute();
                    $result = $lastAttemptTime->get_result();
                    $row = $result->fetch_assoc();
                    $lastAttemptTimestamp = $row['last_attempt_time'];

                    $resetTimeBoundary = strtotime($resetDuration, strtotime($lastAttemptTimestamp));

                    if ($resetTimeBoundary <= time()) {
                        $resetAttempts = $conn->prepare("DELETE FROM reset_attempts WHERE ip_address = ? AND user_id = ?");
                        $resetAttempts->bind_param("si", $ipAddress, $uID);
                        $resetAttempts->execute();
                        $attemptCount = 0;
                    } else {
                        throw new Exception("Rate limit exceeded. Please try again later");
                    }
                }

                // Continue with the rest of your code for generating the token and sending the email


                else {
                    $token = generateToken();
                    $hashToken = password_hash($token, PASSWORD_DEFAULT);
                    $tokenExpiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expiry set to 1 hour from now
                    $updateToken = $conn->prepare("UPDATE adduser SET reset_token=?, reset_token_expiry=? WHERE uID=?");
                    $updateToken->bind_param("ssi", $hashToken, $tokenExpiry, $uID);
                    $updateToken->execute();
                    // Update/reset reset attempts after successful reset
                    updateResetAttempts($ipAddress, $uID);
                    $resetLink = 'http://localhost:3000/root/Admin/SentResetLink.php?token=' . $token;
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
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Password reset';
                    $mail->Body = 'Here\'s the link to reset your password: ' . $resetLink;
                    $mail->send();
                    $response = [
                        "status" => "Success",
                        "message" => "Reset email has been sent",
                        "icon" => "success",
                    ];
                    header("Content-Type: application/json");
                    echo json_encode($response);
                    exit();
                }
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

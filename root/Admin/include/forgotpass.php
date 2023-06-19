<?php
require_once "../../../config/config.php";
require "../../include/src/autoload.php";
use ReCaptcha\ReCaptcha; // Include the reCAPTCHA library


if (isset($_POST["resetBtn"])) {
  $token = $_POST["token"];
  $email = $_POST["email"];
  $newPassword = $_POST["newPassword"];
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $hashedToken = password_hash($token, PASSWORD_DEFAULT);
  $recaptchaResponse = $_POST["gRecaptchaResponse"]; // Get the reCAPTCHA response
  
  // Verify the reCAPTCHA response
  $recaptcha = new ReCaptcha(CAPCHA_SECRETKEY); // Replace with your secret key
  $recaptchaResult = $recaptcha->verify($recaptchaResponse);


  $getAccount = $conn->prepare(
    "SELECT reset_token FROM adduser WHERE email = ?"
  );
  $getAccount->bind_param("s", $email);

  try {
    if (!$getAccount->execute()) {
      throw new Exception(
        "There was a problem executing the query: " . $conn->error
      );
    } else {
      $result = $getAccount->get_result();
      if ($result->num_rows === 0) {
        throw new Exception("Email address does not exist");
      } else {
        $row = $result->fetch_assoc();
        $storedToken = $row["reset_token"];
        if (!$recaptchaResult->isSuccess()) {
          throw new Exception("reCAPTCHA verification failed.");
       }else{
        if (!password_verify($token, $storedToken)) {
          throw new Exception("Invalid token");
        }

        $updatePassword = $conn->prepare(
          "UPDATE adduser SET pwdUsers = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?"
        );
        $updatePassword->bind_param("ss", $hashedPassword, $email);
        $updatePassword->execute();

        $response = [
          "status" => "Success",
          "message" => "Your password has been reset successfully",
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

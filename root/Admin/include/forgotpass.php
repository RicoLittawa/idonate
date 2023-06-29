<?php
require_once "../../../config/config.php";
if (isset($_POST["resetBtn"])) {
  $token = $_POST["token"];
  $email = $_POST["email"];
  $newPassword = $_POST["newPassword"];
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $hashedToken = password_hash($token, PASSWORD_DEFAULT);
  $recaptchaResponse = $_POST["recaptchaResponse"]; // Get the reCAPTCHA response
  $secret_key = '6LddXa4mAAAAAKqUpy5fbcIbBdzv2uv-zeHtWHzu';
  $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptchaResponse}");
  $captcha_success=json_decode($verify);
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
        if ($captcha_success->success==false) {
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

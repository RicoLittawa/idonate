<?php
session_start();
require_once '../../../config/config.php';
require "../../include/src/autoload.php";
use ReCaptcha\ReCaptcha; // Include the reCAPTCHA library


if (isset($_POST['submitBtn'])) {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $recaptchaResponse = $_POST["gRecaptchaResponse"]; // Get the reCAPTCHA response

     // Verify the reCAPTCHA response
     $recaptcha = new ReCaptcha(CAPCHA_SECRETKEY); // Replace with your secret key
     $recaptchaResult = $recaptcha->verify($recaptchaResponse);
    try {
        if (!$conn) {
            throw new Exception('There was a problem connecting to the database');
        } else {
            $userLogin =  $conn->prepare("SELECT * FROM adduser WHERE email = ?");
            if (!$userLogin) {
                throw new Exception('There was a problem executing the query' . $conn->error);
            } else {
                $userLogin->bind_param('s', $userEmail);
                $userLogin->execute();
                $result = $userLogin->get_result();

                if ($result->num_rows == 0) {
                    throw new Exception("Invalid email or password.");
                } else {
                    while ($row = $result->fetch_assoc()) {
                        $hash = $row['pwdUsers'];
                        if (!$recaptchaResult->isSuccess()) {
                           throw new Exception("reCAPTCHA verification failed.");
                        }else{
                            if (password_verify($userPassword, $hash)) {
                                $userID = $row["uID"];
                                $role=  $row['role'];
                                $_SESSION["user"] = [
                                    "uID" => $userID,
                                    "role" => $role,
                                ];
    
                                $status = 'active';
                                $updateStatus = $conn->prepare("UPDATE adduser SET status = ?, logged_in = CURRENT_TIMESTAMP,logged_out=null WHERE uID = ?");
                                $updateStatus->bind_param('si', $status, $userID);
                                $updateStatus->execute();
    
                                if ($_SESSION["user"]['role'] == 'admin') {
                                    $response = [
                                        "status" => "Success",
                                        "message" => "You are logged in",
                                        "icon" => "success",
                                        "data" => "Admin"
                                    ];
                                    header("Content-Type: application/json");
                                    echo json_encode($response);
                                    exit();
                                }
                                if ($_SESSION["user"]['role'] == 'user') {
                                    $response = [
                                        "status" => "Success",
                                        "message" => "You are logged in",
                                        "icon" => "success",
                                        "data" => "User"
                                    ];
                                    header("Content-Type: application/json");
                                    echo json_encode($response);
                                    exit();
                                }
                            } else {
                                throw new Exception("Invalid email or password.");
                            }
                        }
                       
                    }
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

<?php
session_start();
require_once '../../../config/config.php';
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    header("Location: ../error/ForbiddenPage.html");
    exit();
}
if (isset($_POST['submitBtn'])) {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $recaptchaResponse = $_POST["recaptchaResponse"]; 
    $secret_key = '6LddXa4mAAAAAKqUpy5fbcIbBdzv2uv-zeHtWHzu';
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptchaResponse}");
    $captcha_success=json_decode($verify);
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
                        if ($captcha_success->success==false) {
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

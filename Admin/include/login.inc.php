<?php
session_start();
require_once 'connection.php';

if (isset($_POST['login-submit'])){

    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    if (empty($userEmail) || empty($userPassword)) {
        $_SESSION['error'] = 'Email or Password are empty.';
        header("location: ../login.php");
        exit();
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email address.';
        header("location: ../login.php");
        exit();
    }

    $sql = "SELECT * FROM adduser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userEmail);

    try {
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            $_SESSION['error'] = 'Invalid email or password.';
            header("location: ../login.php");
            exit();
        } else {
            while($row = $result->fetch_assoc()){
                $hash = $row['pwdUsers'];
                if (password_verify($userPassword, $hash)) {
                    $userID = $row["uID"];

                    $_SESSION["user"] = [
                        "uID" => $row["uID"],
                        "logged_in" => true,
                        "role" => $row['role']
                    ];
                    $status = 'active';
                    $updateStatus = "UPDATE adduser SET status = ? WHERE uID = ?";
                    $stmt2 = $conn->prepare($updateStatus);
                    $stmt2->bind_param('si', $status, $userID);
                    $stmt2->execute();
                   if($_SESSION["user"]['role']=='admin'){
                    header("Location: ../adminpage.php");
                    exit();
                   }
                    else{
                        header("Location: ../userlandingpage.php");
                    exit();
                    }
                    
                } else {
                    $_SESSION['error'] = 'Invalid email or password.';
                    header("location: ../login.php");
                    exit();
                }
            }
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

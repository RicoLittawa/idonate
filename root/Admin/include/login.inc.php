<?php
session_start();
require_once '../../../config/config.php';
if (isset($_POST['submitBtn'])){

    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $sql = "SELECT * FROM adduser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userEmail);

    try {
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            throw new Exception("Invalid email or password.");
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
                    $stmt = $conn->prepare($updateStatus);
                    $stmt->bind_param('si', $status, $userID);
                    $stmt->execute();
                   if($_SESSION["user"]['role']=='admin'){
                        echo "admin";
                   }
                    if ($_SESSION["user"]['role']=='user'){
                       echo "user";
                    }
                    $stmt->close();
                } else {
                   throw new Exception("Invalid email or password.");
                }
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    finally{
        $conn->close();
    }
}
?>

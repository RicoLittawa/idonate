<?php
require_once 'connection.php';

if (isset($_POST['login-submit'])){
    $userEmail= $_POST['userEmail'];
    $userPassword= $_POST['userPassword'];
    $sql= "SELECT * from adduser where email=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param('s',$userEmail);

    try {
        $stmt->execute();
        $result= $stmt->get_result();

        if($result->num_rows == 0) {
            echo "Invalid email or password.";
        } else {
            while($row=$result->fetch_assoc()){
                $hash=$row['pwdUsers'];
                if (password_verify($userPassword,$hash)){
                    session_start();
                    $_SESSION["firstname"] = $user["firstname"];
                    $_SESSION["lastname"] = $user["lastname"];
                    $_SESSION["uID"] = $user["id"];
                    $_SESSION["role"] = $user["role"];
                    $_SESSION["logged_in"] = true; 
                    
                    header("location: ../adminpage.php?loggegin");
                    //success
                }else{
                    echo "Invalid email or password.";
                }
            }
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


<?php 
if(isset($_POST['login-submit'])){
    require 'connection.php';
    $Email = $_POST['userEmail'];
    $Password = $_POST['userPassword'];
    if (empty($Email)||empty($Password)){
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT *FROM useradmin WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../login/login.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s", $Email);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
        
        if($row= mysqli_fetch_assoc($result)){
            $pwdCheck = password_verify($Password, $row['pwdUsers']);
            if ($pwdCheck == false){
                header("Location: ../login/login.php?error=wrongpassword");
                exit();

            }
            else if ($pwdCheck == true){
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['uID'];
                header("Location: ../adminpage.php");
            exit();
            }
            else{
                header("Location: ../login/login.php?error=wrongpassword");
                exit();
            }
             }
             else{
                header("Location: ../login/login.php?error=nouser");
                exit();
             }
        }
    }
}

else{
    header("Location: ../login/login.php");
    exit();
}
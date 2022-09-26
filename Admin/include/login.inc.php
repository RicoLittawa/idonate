<?php 

session_start(); 

include "connection.php";

if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $Email = validate($_POST['userEmail']);

    $Password = validate($_POST['userPassword']);

    if (empty($Email)) {
        header("Location: ../login/login.php?error=User Name is required");
        exit();

    }else if(empty($Password)){

        header("Location: ../login/login.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM useradmin WHERE email='$Email' AND pwdUsers='$Password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $Email && $row['pwdUsers'] === $Password) {

                echo "Logged in!";

                $_SESSION['email'] = $row['pwdUsers'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['uID'];

                header("Location: /admin/adminpage.php");

                exit();

            }else{
                header("Location: ../login/login.php?error=Incorect Email or password");

                exit();

            }

        }else{
            header("Location: ../login/login.php?error=Incorect Email or password");

            exit();

        }

    }

}else{

    header("Location: /login/login.php");

    exit();

}
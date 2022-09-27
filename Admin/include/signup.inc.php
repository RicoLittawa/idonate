<?php 


if (isset($_POST['signup-submit'])){
   require 'connection.php';
    $Email= $_POST['email'];
    $Password= $_POST['pwd'];
    $ConfirmPass= $_POST['pwd-repeat'];
    $Fname=$_POST['fName'];
    
    if(empty($Email)||empty($Password)||empty($ConfirmPass)||empty($Fname)){
      header("Location: ../login/signup.php?error=emptyfields&email=".$Email);
   }
   else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
       header("Location: ../login/signup.php?error=emptyfield&email=".$Email);
       exit();
   }
   else if ($Password !== $ConfirmPass){
       header("Location: ../login/signup.php?error=passwordcheck");
       exit();
   }
   else{
       $sql = "SELECT email  FROM useradmin WHERE email=?";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../login/signup.php?error=sqlerror");
           exit();
       }
       else{
         mysqli_stmt_bind_param($stmt,"s",$Email);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
           $resultCheck= mysqli_stmt_num_rows($stmt);
           if($resultCheck > 0){
               header("Location: ../login/signup.php?error=usertaken&email=".$Email);
               exit();
           }
           else {
               $sql = "INSERT INTO useradmin (name,email,pwdUsers) VALUES (?,?,?)" ;
               $stmt= mysqli_stmt_init($conn);
               if(!mysqli_stmt_prepare($stmt,$sql)){
                   header("Location: ../login/signup.php?error=sqlerror");
                   exit();
               }
               else{
                   $hashedPwd= password_hash($Password, PASSWORD_DEFAULT);
   
                   mysqli_stmt_bind_param($stmt,"sss",$Fname,$Email, $hashedPwd);
                   mysqli_stmt_execute($stmt);
                   header("Location: ../login/signup.php?signup=success");
                   exit();
               }
           }
   
       }
   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
else {
   header("Location: ../login/signup.php");
               exit();
}
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once 'connection.php';
if(isset($_POST['submitBtn'])){
   $fname = trim($_POST['fname']);
   $lname = trim($_POST['lname']);
   $position = trim($_POST['position']);
   $email = trim($_POST['email']);
   $password = $_POST['password'];
   $address = trim($_POST['address']);
   $selectedValue = $_POST['selectedValue'];
   
 

     // Insert the new record
     $sql = 'INSERT INTO adduser (firstname, lastname, position, email, pwdUsers, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)';
     $stmt = $conn->prepare($sql);
     try {
       if (!$stmt) {
         throw new Exception('There was a problem executing the query.');
       } else {
         $hashPW = password_hash($password, PASSWORD_DEFAULT);
         $stmt->bind_param('sssssss', $fname, $lname, $position, $email, $hashPW, $address, $selectedValue);
         $result= $stmt->execute();
         if($result){
            // Send email
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'testcdrrmo@gmail.com';                     // SMTP username
            $mail->Password   = 'mlytxekfgplnhsap';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            // Recipients
            $mail->setFrom('testcdrrmo@gmail.com');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your account has been created';
            $mail->Body = 'Your account has been created successfully. You can use the email and password to login to the system.

            Fullname: '.$fname.' '.$lname.'
            Email: '.$email.'
            Password: '.$_POST['password'].'
            
            After that, you can update your password.';

            $mail->send();
            echo "success";
            
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         

            $stmt->close();
         }
       }
     } catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062) {
          // Handle duplicate email error
          echo "Email already exists";
      } else {
          // Handle other MySQL errors
          echo "MySQL Error: " . $e->getMessage();
      }
  } catch (Exception $e) {
      // Handle other non-MySQL errors
      echo $e->getMessage();
  }
  finally{
    $conn->close();
  }
  
  
}


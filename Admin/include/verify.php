<?php 
   
    use PHPMailer\PHPMailer\PHPMailer;
  
   
 if(isset($_POST['email_data'])){
  require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';
  
   require_once 'connection.php';
  
  

  foreach($_POST['email_data']as $row)
  {
      $id= $row['uID'];
      // $statusSql= "SELECT status from set_request where request_id=?";
      // $stmt= $conn->prepare($statusSql);
      // $stmt->bind_param('i',$id);
      // $stmt->execute();
      // $result = $stmt->get_result(); 
      // $user = $result->fetch_assoc();
      // $message= $user['status'];
      $message= 'Verified';
    
      $mail = new PHPMailer;
      $mail->IsSMTP();        //Sets Mailer to send message using SMTP
      $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
      $mail->Port = '465';        //Sets the default SMTP server port
      $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
      $mail->Username = 'testcdrrmo@gmail.com';     //Sets SMTP username
      $mail->Password = 'mlytxekfgplnhsap';     //Sets SMTP password
      $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
      $mail->From = 'testcdrrmo@gmail.com';   //Sets the From email address for the message
      $mail->FromName = 'Code With Nevil'; 
      $mail->setFrom('testcdrrmo@gmail.com');    //Sets the From name of the message
      $mail->AddAddress($row["email"], $row["name"]); //Adds a "To" address
      $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);       //Sets message type to HTML
      $mail->Subject = 'Verifide'; //Sets the Subject of the message
      //An HTML or plain text message body
      $mail->Body = '
      <p>Certificate...</p>
      ';
      $mail->Send();      //Send an Email. Return true on success or false on error
      $sql="UPDATE set_request set status=? where request_id=?";
      $stmt= $conn->prepare($sql);
      $stmt->bind_param('si',$message,$id);
      $stmt->execute();
      echo "verified";
  }
 
}





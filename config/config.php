<?php
define('SMTP_USERNAME', 'cityriskreductionoffice@i-donate-btg.com');
define('SMTP_PASSWORD', 'Cityriskreductionoffice01!');
define('CAPCHA_SECRETKEY', '6LddXa4mAAAAAKqUpy5fbcIbBdzv2uv-zeHtWHzu');
define('CAPTCHA_SITEKEY', '6LddXa4mAAAAALVtpP0nf7GZsDF1SRf052K9Xzk8');






define('DB_USERNAME', 'u321569821_idonate');
define('DB_PASSWORD', 'Idonate123');

$server_name="localhost";
$username="root";
$password="";
$database_name=DB_USERNAME;

try {
    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    if(!$conn) {
        throw new Exception(mysqli_connect_error());
    }
} catch(Exception $e) {
    echo $e->getMessage();
    header("Location: ../error/SomethingWentWrong.html");
    exit();
}

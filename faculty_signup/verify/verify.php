<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('../../authentication/connection.php');
require 'vendor/autoload.php';


$email = $_GET['email'];
$enroll = substr($email, 0, 10);

function send_link($email){
  require('../../authentication/connection.php');
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->SMTPAuth = true;
  $mail->Username = 'ts3477524@gmail.com';
  $mail->Password = 'uycx lplv kwoq mhnb';
  $mail->setFrom('ts3477524@gmail.com', 'Tushar Singh');
  $mail->addReplyTo('ts3477524@gmail.com', 'Tushar Singh');
  $mail->addAddress($email);
  $mail->isHTML(true);

  $mail->Subject = 'Email verification';

  $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $verification_token = md5($email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $verification_token = $verification_token . $addKey;

  $email_template = "
  <h5>Verify you email to register for Using Bus Services with the link given below</h5>
  <br>
  <a href='http://localhost/faculty_signup/signup/signup.php?token=$verification_token&email=$email'>Verify Link</a>
  <h5>DO NOT SHARE THIS LINK WITH ANYONE</h5>
";

  $mail->Body = $email_template;

  if(!$mail->send()){
    echo "Error : 1";

  }else{

    $add_user = "INSERT INTO token (`email` , `token`, `expirydate`) VALUES ('$email', '$verification_token', '$expDate')";
    if($conn->query($add_user)){
      echo "Verification link sent!!";
    }else {
      echo "Error : 2";
    }

  }
}

$check_student = "SELECT * FROM faculty WHERE faculty_id='$email'";
$result = $conn->query($check_student);

if($result->num_rows > 0){
  echo "User already exists!!";
}
else{
  send_link($email);

}
?>

<?php
session_start();
require('../../authentication/connection.php');
$email = $_GET['email'];
$token = $_GET['token'];
$currentDate = date("Y-m-d H:i:s");

$check_token = "SELECT * FROM token WHERE email = '$email' AND token = '$token' ";
$result = $conn->query($check_token);

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, intial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie-edge" />
      <link rel="stylesheet" href="signup.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

      <title>Signup</title>
   </head>
<?php 

if($result->num_rows === 1){
    $row = $result->fetch_assoc();
    if($row['expirydate'] >= $currentDate ){

      $username = substr($email, 0, 10);
      $_SESSION['user']=$username;
      $_SESSION['email']=$email;
?>
   <body>
      <div class="container" id="container">
      <form name="signup" action = "save.php" onsubmit="return validateForm()" method = "POST" class="f1">
         <br>
         <h1>Register Form</h1>
         <br><div>
         <input type="text" name="name" id="name"  placeholder="Full name" />
         <p style="color:red;" id="name-error" hidden></p>
         <input type="text" name="email" id="email" value="<?php echo $email; ?>" disabled />
         <input type="password" name="pass" id="pass" placeholder="Password"/>
<span class="material-symbols-outlined password-icon" id="info-btn">
                        info
                    </span>
                    <div class="info-box" id="info-box">
                        <p>Your password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</p>
                    </div>

         <span style="color:red;" id="password-error" hidden></span>
         <input type="password" name="repass" id="repass" placeholder="Confirm password" />
         <span style="color:red;" id="confirm-error" hidden></span>             
         <p style="color:red;" id="test" hidden></p></div>
         <input
            class="button"
            type="submit"
            id="button"
            name="commit"
            value="Submit"
            tabindex="3"
            class="lastInput"
            style="margin:12px;border-radius:0.5rem"
            /> 
      </form>
      <br>
   </body>
      <script src="signup.js"></script>

</html>
<?php    

    }  
}else echo "Link Expired";

?>

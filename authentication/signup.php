<?php

require('connection.php'); 
session_start();
$error = "";
    $fname= $_POST['name'];
    $usernow = $_POST['user'];
    $emailnow = $_POST['email'];
    $passnow = $_POST['pass'];
    $PCnow = $_POST['repass']; 
    if (!$fname) {
      $error .= "Name is required <br>";
    }

    if (!$emailnow) {
      $error .= "Email is required <br>";
    }
    else{
        $sql = "SELECT * FROM student WHERE email = '$emailnow'"; 
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
	    if(mysqli_num_rows($result)===1){
            $error .= "Email already taken <br>";
        }
    } 
    
    if (!$usernow) {
      $error .= "Username is required <br>";
    }
    else{
        $sql = "SELECT * FROM student WHERE username = '$usernow'"; 
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
	    if(mysqli_num_rows($result)===1){
            $error .= "Username already taken <br>";
        }
    } 

    if (!$passnow) {
      $error .= "Password is required <br>";
    }
    else{
        if(!$PCnow){
            $error .= "Please confirm password";
        }
        else{
            if($passnow != $PCnow){
                $error .= "Passwords do not match";
            }
        }
    }


    if ($error) {
        echo $error;
        echo "<br> Please go back";
     } 
    else{
        //$hash = password_hash($passnow, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `student`  VALUES ('$usernow','$fname','$passnow','$emailnow')";
        $result = mysqli_query($conn,$sql);
        header("Location:../index.html");
        exit();
    }
?>

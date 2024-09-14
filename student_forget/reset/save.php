<?php
session_start();
require('../../authentication/connection.php');

$email = $_SESSION['email'];
$pass = $_POST['pass'];
$hashpass = md5($pass);


$sql = "UPDATE student SET password='$hashpass' WHERE email='$email'";
$result = $conn->query($sql);

$sql2 = "DELETE FROM token WHERE email = '$email'";
$result2 = $conn->query($sql2);

session_unset();
session_destroy();

header("Location:../../index.php");

?>

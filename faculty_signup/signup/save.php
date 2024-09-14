<?php
session_start();
require('../../authentication/connection.php');

$name = $_POST['name'];
$email = $_SESSION['email'];
$pass = $_POST['pass'];
$hashpass = md5($pass);

$sql = "INSERT INTO faculty VALUES('$email','$name','$hashpass')";
$result = $conn->query($sql);

$sql2 = "DELETE FROM token WHERE email = '$email'";
$result2 = $conn->query($sql2);

session_unset();
session_destroy();

header("Location: ../../index.php");

?>

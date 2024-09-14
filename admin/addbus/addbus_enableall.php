<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['busid'];
$sql="UPDATE `bus` SET `status` = 'true' WHERE status ='false'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Enabling successful!</p>";
    header("location:addbus.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
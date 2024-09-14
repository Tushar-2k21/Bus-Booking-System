<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['busid'];
$sql="UPDATE `bus` SET `status` = 'false' WHERE bus_id='$temp'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Disabling successful!</p>";
    header("location:addbus.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
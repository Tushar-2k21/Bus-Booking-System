<?php
include('../authentication/connection.php');
session_start();
$ticket_id=$_POST['ticket_id'];
$user=$_SESSION['usernow'];
$role = $_SESSION['role'];
$bus_id =$_POST['bus_id'];
$current_date=date('Y-m-d');
// Increment the seats of the bus
$sql1 = "UPDATE bus SET seats = seats + 1 WHERE bus_id = $bus_id";
if ($conn->query($sql1) === FALSE) {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$sql2 = "DELETE FROM ticket WHERE id='$user' AND date='$current_date'";

if ($conn->query($sql2) === TRUE) {
    echo "<p>Cancelling successful!</p>";
    header("location:../cancel/cancel.php"); 
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
?>

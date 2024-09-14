<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['faculty_id'];

$sql1="DELETE FROM ticket WHERE id='$temp'";
$result1=mysqli_query($conn,$sql1);

$sql="DELETE FROM faculty WHERE faculty_id='$temp'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Deleting successful!</p>";
    header("location:addfaculty.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

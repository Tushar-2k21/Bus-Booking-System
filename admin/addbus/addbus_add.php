
<?php
session_start();
require('../../authentication/connection.php');

$bid = $_POST['bus_id'];
$brole = $_POST['role'];
$seats = $_POST['seats'];
$status = "true";

$sql1="SELECT * FROM bus WHERE bus_id ='$bid'";
$query1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($query1);
if($num1 > 0){
    echo 'bus_id';
    exit();
}

$sql = "INSERT INTO bus (`bus_id`,`seats`,`role`,`status`)
        VALUES ('$bid','$seats','$brole','$status')";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo 'success';
} 
else {
    echo 'error';
}
?>






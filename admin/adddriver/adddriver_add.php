<?php
session_start();
include('../../authentication/connection.php');
$did = $_POST['driver_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];

$sql1="SELECT * FROM driver WHERE driver_id = '$did'";
$query1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($query1);
if($num1 > 0){
    echo 'driver_id';
    exit();
}

$sql2="SELECT * FROM driver WHERE phone = '$phone'";
$query2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($query2);
if($num2 > 0){
    echo 'phone';
    exit();
}


$sql="INSERT INTO driver VALUES ('$did','$name','$phone')";
$query =mysqli_query($conn,$sql);
if($query){
    echo 'success'; 
}
else{
    echo 'Value exists';
}

?>

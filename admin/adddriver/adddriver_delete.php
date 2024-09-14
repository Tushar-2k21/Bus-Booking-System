<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['driver_id'];

$sql2="SELECT * FROM drives WHERE driver_id ='$temp'";
$query2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($query2);

if($num2>0){
    echo 'driver_id';
    exit();
}


$sql="DELETE FROM driver WHERE driver_id='$temp'";
if ($conn->query($sql) === TRUE) {
    echo "success";
     
} else {
    echo "Error";
}
?>

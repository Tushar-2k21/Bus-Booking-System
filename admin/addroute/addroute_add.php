<?php
session_start();
include('../../authentication/connection.php');
$rid = $_POST['route_id'];
$src = $_POST['source'];
$dest = $_POST['destination'];
$departure_src=$_POST['departure_src'];
$departure_dst=$_POST['departure_dst'];

$sql1="SELECT * FROM route WHERE route_id = '$rid'";
$query1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($query1);
if($num1 > 0){
    echo 'route_id';
    exit();
}

$sql="insert into route values ('$rid','$src','$dest','$departure_src','$departure_dst')";
$query =mysqli_query($conn,$sql);
if($query){            
   echo 'success'; 
}
else{
    echo 'value exists';
}
?>

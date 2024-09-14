<?php
session_start();
include('../../authentication/connection.php');
$bid=$_POST['bus_id'];
$did=$_POST['driver_id'];
$rid=$_POST['route_id'];


$sql1="SELECT * FROM driver WHERE driver_id = '$did'";
$query1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($query1);
if($num1 == 0){
    echo 'driver_id';
    exit();
}

$sql2="SELECT * FROM drives WHERE driver_id = '$did' AND bus_id!='$bid'";
$query2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($query2);

if($num2>0){
    echo 'assign';
    exit();
}

$sql3="SELECT * FROM route WHERE route_id = '$rid'";
$query3=mysqli_query($conn,$sql3);
$num3=mysqli_num_rows($query3);
if($num3 == 0){
    echo 'route_id';
    exit();
}

$sql4="SELECT * FROM drives WHERE bus_id='$bid'";
$query4=mysqli_query($conn,$sql4);
$num4=mysqli_num_rows($query4);

if($num4>0){
    $sql5="UPDATE drives SET driver_id='$did', route_id='$rid' WHERE bus_id='$bid'";
    if($conn->query($sql5)=="TRUE"){
        echo 'success';
        exit();
    }
    else{
        echo 'error';
    }
}

else{
    $sql6="INSERT INTO drives values ('$did','$bid','$rid')";
    if($conn->query($sql6)==TRUE){
        echo 'success';
    }
    else{
        echo 'erro';
    }
}
?>

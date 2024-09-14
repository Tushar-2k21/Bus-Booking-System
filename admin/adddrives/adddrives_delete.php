<?php
session_start();
include('../../authentication/connection.php');
$bid=$_POST['bus_id'];



$sql6="DELETE FROM drives WHERE bus_id='$bid'";
if($conn->query($sql6)==TRUE){
    echo 'success';
    header("location:adddrives.php");
}
else{
    echo 'erro';
}

?>

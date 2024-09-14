<?php

require('authentication/connection.php');

$sql="SELECT bus_id,seats FROM bus";
$result = $conn->query($sql);

if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
          $sql1="SELECT COUNT(*) AS ticket_count FROM ticket WHERE bus_id = " . $row['bus_id'] . " AND date = CURDATE();";
        $result1 = $conn->query($sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $ticket_count = $row1['ticket_count'];
        $bus_seats = $row['seats'];

        $sql2="UPDATE bus SET seats = " . ($ticket_count+$bus_seats) . " WHERE bus_id=" . $row['bus_id'] ." ";
        $conn->query($sql2);
    

  }
}

$one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));
$current_date = date('Y-m-d H:i:s');

$sql3 = "DELETE FROM ticket WHERE date < '$one_week_ago'";
$result3 = $conn->query($sql3);


$sql2= "DELETE FROM token WHERE expirydate < '$current_date'";
$result2 = $conn->query($sql2);

mysqli_close($conn);

?>

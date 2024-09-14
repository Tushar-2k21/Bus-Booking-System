<?php
session_start();
include('../authentication/connection.php');

$role = $_SESSION['role'];
$bus_id = $_POST['bus_id'];
$user = $_SESSION['usernow'];
$booked_seats = 1;
$current_date = date("Y-m-d");
$status = $_POST['status'];
$hello = $user . '-' . $current_date;
$ticket_id = md5($user . '-' . $current_date);

// Begin a transaction with SERIALIZABLE isolation level
$conn->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);

if($status == 'false'){
   echo 'disable';
   exit();
}

// Check if the user has already booked a ticket for the same date
$check_sql = "SELECT * FROM ticket WHERE id='$user' AND date='$current_date'";

$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // User already booked a ticket for the same date
    echo 'No';
}
else {
    // Select the number of available seats and lock the row for update
    $sql1 = "SELECT seats FROM bus WHERE bus_id = $bus_id FOR UPDATE";
    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();

    // Check if there are enough available seats
    if ($row['seats'] >= $booked_seats) {
      // Update the number of available seats
      $new_seats = $row['seats'] - $booked_seats;
      $sql2 = "UPDATE bus SET seats = $new_seats WHERE bus_id = $bus_id";
      $conn->query($sql2);

      // Insert the new ticket
      $sql3 = "INSERT INTO ticket (ticket_id,id,bus_id,date) VALUES ('$ticket_id','$user','$bus_id','$current_date')";
      
      if ($conn->query($sql3) === TRUE) {
        $_SESSION['ticket_id'] = $ticket_id;
        echo 'success'; 
        
      } 
      else {
        echo 'failed';
      }
    }
    else {
      // Not enough available seats
      echo 'no_seats';
    }
}

// Commit the transaction
$conn->commit();

?>

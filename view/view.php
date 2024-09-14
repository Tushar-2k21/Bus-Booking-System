<?php
session_start();
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header("location:../view/view.php");
    exit;
}

require('../authentication/connection.php');
$user= $_SESSION['usernow'];
$enroll = $_SESSION['displayname'];
$role = $_SESSION['role'];
$current_date = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>

    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="view.css">

    <!-- =========== Scripts =========  -->
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="person-circle"></ion-icon>
                        </span>
                        <span class="title">Welcome, <?php echo $_SESSION['displayname']; ?></span>
                    </a>
                </li>

                <li>
                    <a href="../dash/index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="../booking/booking.php">
                        <span class="icon">
                            <ion-icon name="ticket"></ion-icon>
                        </span>
                        <span class="title">Book Ticket</span>
                    </a>
                </li>

                <li>
                    <a href="view.php">
                        <span class="icon">
                            <ion-icon name="eye"></ion-icon>
                        </span>
                        <span class="title">View Ticket</span>
                    </a>
                </li>

                <li>
                    <a href="../cancel/cancel.php">
                        <span class="icon">
                            <ion-icon name="ban-outline"></ion-icon>
                        </span>
                        <span class="title">Cancel Ticket</span>
                    </a>
                </li>

                <li>
                    <a href="../help/help.html">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>                   

                <li>
                    <a href="../logout/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>            <!-- ========================= Main ==================== -->
            

<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </div>
    <div class="cardBox">
        <div class="card">
<?php
           
           

    $sql = "SELECT t.date, t.bus_id, t.ticket_id, r.departure_src, r.departure_dst, r.source, r.destination
FROM ticket t
JOIN drives d ON t.bus_id = d.bus_id
JOIN route r ON r.route_id = d.route_id
WHERE t.date = '$current_date' AND t.id='$user'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
   // $date=$row["date"];
    //echo $date;
                $bus_id = $row["bus_id"];
                $departure_src = $row["departure_src"];
                $departure_dst = $row["departure_dst"];
                $source = $row["source"];
                $destination = $row["destination"];
                $ticket_id = $row["ticket_id"];
                
                echo '<div class="numbers">Ticket Information</div>';
                echo '<div class="cardName"><b>Ticket ID:</b> '.$ticket_id.'</div>';
                echo '<div class="cardName"><b>Bus ID:</b> '.$bus_id.'</div>';
                echo '<div class="cardName"><b>Source:</b> '.$source.'</div>';
                echo '<div class="cardName"><b>Departure Time From Source:</b> '.$departure_src.'</div>';
                echo '<div class="cardName"><b>Destination:</b> '.$destination.'</div>';
                echo '<div class="cardName"><b>Departure Time From Destination:</b> '.$departure_dst.'</div>';

               
            }else {
                echo "<p>No ticket booked for today</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>
</div>
</div>
    <script src="view.js"></script>
   </body>
</html>

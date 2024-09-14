<?php
session_start();
if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']) {
    header("location:../booking/booking.php");
}

?>

<?php 
require ('../authentication/connection.php');
$enroll = $_SESSION['displayname'];
$role= $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking</title>

        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="booking.css">
       <!-- =========== Scripts =========  -->
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                        <a href="booking.php">
                            <span class="icon">
                                <ion-icon name="ticket"></ion-icon>
                            </span>
                            <span class="title">Book Ticket</span>
                        </a>
                    </li>

                    <li>
                        <a href="../view/view.php">
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
            </div>

            <!-- ========================= Main ==================== -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>    
                </div>

                <div class="details">
                      <h1>Bus Schedule</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Departure from source</th>
                                    <th>Source</th>
                                    <th>Departure from destination</th>
                                    <th>Destination</th>
                                    <th>Seats</th>
                                    <th>Book</th>
                                </tr>
                            </thead>
                        <tbody>
                        <?php
                        session_start();
                        $sql = "SELECT b.bus_id, b.role, b.status,r.departure_src, r.source, r.destination, r.departure_dst, b.seats
                                    FROM bus AS b
                                    JOIN drives AS d ON b.bus_id = d.bus_id
                                    JOIN route AS r ON r.route_id = d.route_id WHERE b.role='$role'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["bus_id"] . "</td>";
                                    echo "<td>" . $row["departure_src"] . "</td>";
                                    echo "<td>" . $row["source"] . "</td>";
                                    echo "<td>" . $row["departure_dst"] . "</td>";
                                    echo "<td>" . $row["destination"] . "</td>";
                                    echo "<td>" . $row["seats"] . "</td>";
                                    echo "<td>
                                    <input type='hidden' name='bus_id' id='bus_id' value='" . $row["bus_id"] . "'>
                                    <input type='hidden' name='user' value='" . $row["seats"] . "'>
                                    <input type='hidden' name='status' id='status' value='" . $row["status"] . "'>
                                    <input type='submit' value='Book' class='button' onclick='validateForm(this)' />
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                        ?>
                        </tbody>
                    </table>
                <p style="color:red" id="test" ></p>
                </div>
            </div>
        </div>
<script>
    function validateForm(button) {
        let bus = button.parentNode.querySelector("#bus_id").value;
        let status = button.parentNode.querySelector("#status").value;
        console.log(bus);
        sendData(bus,status);
        return true;
    }  

    function sendData(bus,status) {
        $.ajax({
            type: "POST",
            url: "booking_ticket.php",
            data: { 
                bus_id:bus,
                status:status
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'No'){
                    $('#test').html('You can book only one seat in a day') 
                }
                else if(response=='success'){
                    window.location.href = '../view/view.php';
                }
                else if(response=='no_seats'){
                    $('#test').html('No seats available');
                }
                else if(response=='disable'){
                    $('#test').html('Bus is not available today, please try tommorow');
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }
</script>
        <script src="booking.js"></script>
   </body>
</html>

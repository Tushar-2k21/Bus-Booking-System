<?php
   session_start();
   if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']){
      header("location:../index.php");
   }
   
   ?>
<?php 
   require ('../authentication/connection.php');
   $enroll = $_SESSION['displayname'];
   $role= $_SESSION['role']; 
   $one_week_ago = date("Y-m-d", strtotime("-1 week"));
   $user_id = $_SESSION['usernow'];
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard</title>
      <!-- ======= Styles ====== -->
      <link rel="stylesheet" href="assets/css/style.css">
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
               <a href="index.php">
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
         <!-- ======================= Cards ================== -->
         <?php
            // Assuming you have already establ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ished a database connection
            $query = "SELECT COUNT(*) FROM bus NATURAL JOIN drives WHERE bus.bus_id=drives.bus_id AND bus.role='$role'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_fetch_array($result)[0];
            ?>
         <div class="cardBox">
            <div class="card">
               <div>
                  <div class="numbers"><?php echo $count; ?></div>
                  <div class="cardName">Buses Available</div>
               </div>
               <div class="iconBx">
                  <ion-icon name="bus-sharp"></ion-icon>
               </div>
            </div>
         </div>
         <!-- ================ Order Details List ================= -->
         <div class="details">
               <div class="recentOrders">
            <h1>Recent Bookings</h1><br>
            <?php
               $sql = "SELECT * FROM ticket WHERE id ='$user_id' AND date >= '$one_week_ago'";
               $result = $conn->query($sql);
               if ($result->num_rows == 0) {
                  echo "<p>No bookings found.</p>";
                 
               } else {
                 echo '<table class="content-table">
                   <thead>
                     <tr>
                       <th>Ticket Id</th>
                       <th>Source</th>
                       <th>Destination</th>
                       <th>Date</th>
                     </tr>
                   </thead>
                   <tbody>';
                 while ($row = $result->fetch_assoc()) {
                   $sql2 = "SELECT * FROM drives NATURAL JOIN route WHERE drives.bus_id = '". $row['bus_id']."'AND route.route_id=drives.route_id";
                   $result2 = $conn->query($sql2);
                   $row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                   $source = $row1['source'];
                   $destination = $row1['destination'];
                   echo "<tr>
                     <td>" . $row["ticket_id"] . "</td>
                     <td>$source</td>
                     <td>$destination</td>
                     <td>" . $row["date"] . "</td>
                   </tr>";
                 }
                 echo '</tbody></table>';
               }
               ?>
         </div>
</div>
         <!-- ================= New Customers ================ -->
               </div>
      <!-- =========== Scripts =========  -->
      <script src="assets/js/main.js"></script>
      <!-- ====== ionicons ======= -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
   </body>
</html>

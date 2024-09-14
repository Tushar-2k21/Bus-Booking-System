
<?php
session_start();
if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']){
   header("location:../index.php");
}
?>
<?php
include('../../authentication/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
   
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="../assets/css/style.css">

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
                            <span class="title">Welcome,Admin</span>
                        </a>
                    </li>

                    <li>
                        <a href="../adminindex.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="../addbus/addbus.php">
                            <span class="icon">
                                <ion-icon name="bus"></ion-icon>
                            </span>
                            <span class="title">Edit Buses</span>
                        </a>
                    </li>

                   

                    <li>
                        <a href="../adddriver/adddriver.php">
                            <span class="icon">
                                <ion-icon name="person"></ion-icon>
                            </span>
                            <span class="title">Edit Drivers</span>
                        </a>
                    </li>                
                    <li>
                        <a href="../addroute/addroute.php">
                            <span class="icon">
                                <ion-icon name="location"></ion-icon>
                            </span>
                            <span class="title">Edit Route</span>
                        </a>
                    </li>  
                    <li>
                        <a href="../addfaculty/addfaculty.php">
                            <span class="icon">
                                <ion-icon name="book"></ion-icon>
                            </span>
                            <span class="title">Edit Faculty</span>
                        </a>
                    </li>   
                    <li>
                        <a href="../addstudent/addstudent.php">
                            <span class="icon">
                                <ion-icon name="school"></ion-icon>
                            </span>
                            <span class="title">Edit Students</span>
                        </a>
                    </li>  
                    <li>
                        <a href="../../logout/logout.php">
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
                      <h1>All Buses List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Seats</th>
                                    <th>Driver ID</th>
                                    <th>Route ID</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM bus";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["bus_id"] . "</td>";
                                    echo "<td>" . $row["seats"] . "</td>";
                                    echo "<td>
                                    <input type='number' name='driver_id' id='driver_id_" . $row["bus_id"] . "' placeholder='Driver_id'></td>";
                                    echo "<td>
                                    <input type='number' name='route_id' id='route_id_" . $row["bus_id"] . "' placeholder='Route_id'></td>";

                                    echo "<td>

                                    <input type='hidden' name='hidden_bus_id' value='" . $row["bus_id"] . "' id = 'hidden_bus_id' >
                                    <input type='hidden' name='hidden_driver_id' value='' id = 'hidden_driver_id_" . $row["bus_id"] . "' >
                                    <input type='hidden' name='hidden_route_id' value='' id = 'hidden_route_id_" . $row["bus_id"] . "' >
                                    <input type='submit' value='ASSIGN' class='btton' onclick='validateForm(this)' />                  
                                                                        
                                    </td>";
echo "<script>
      document.getElementById('driver_id_" . $row["bus_id"] . "').addEventListener('input', function() {
          document.getElementById('hidden_driver_id_" . $row["bus_id"] . "').value = this.value;
      });
      
      document.getElementById('route_id_" . $row["bus_id"] . "').addEventListener('input', function() {
          document.getElementById('hidden_route_id_" . $row["bus_id"] . "').value = this.value;
      });
      </script>";

                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>
                <div class="details">
                      <h1>Assinged Buses List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Driver ID</th>
                                    <th>Route ID</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM drives";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["bus_id"] . "</td>";
                                    echo "<td>" . $row["driver_id"] . "</td>";
                                    echo "<td>" . $row["route_id"] . "</td>";
                                    echo "<td>
                                    <form action='adddrives_delete.php' method='POST'> 
                                    <input type='hidden' value='" . $row['bus_id'] . " ' name='bus_id' id='bus_id' >
                                    <button type='submit'>DELETE</button>
                                    </form>                                    
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>



<br>
                <p style="color:red" id="test" ></p>

                </div>
            </div>
        </div>
   </body>
<script>
    function validateForm(button) {
        let bid = button.parentNode.querySelector('#hidden_bus_id').value;
        let did = button.parentNode.querySelector("#hidden_driver_id_"+bid).value;
        let rid = button.parentNode.querySelector('#hidden_route_id_'+bid).value; 
       
        sendData(bid,did,rid);
        return true;
    }  

    function sendData(bid,did,rid) {
        $.ajax({
            type: "POST",
            url: "adddrives_assign.php",
            data: { 
                bus_id:bid,
                driver_id:did,
                route_id:rid  
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'driver_id'){
                    $('#test').html('There is no driver with this ID'); 
                }
                else if(response === 'assign'){
                    $('#test').html('Driver is already assinged to another bus'); 
                }
                else if(response === 'route_id'){
                    $('#test').html('No Route present with this ID'); 
                }

                else if(response=='success'){
                    window.location.href = 'adddrives.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }
</script>
        <script src="../assets/js/main.js"></script>

</html>


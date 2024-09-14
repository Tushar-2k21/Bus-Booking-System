<?php
session_start();
if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']){
   header("location:index.php");
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
        <title>Admin Delete</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="../assets/css/style.css">

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
                            <span class="title">Welcome, Admin</span>
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
                        <a href="../adddrives/adddrives.php">
                            <span class="icon">
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </span>
                            <span class="title">Assign</span>
                        </a>
                    </li>


                    <li>
                        <a href="../adddriver/adddriver.php">
                            <span class="icon">
                                <ion-icon name="person"></ion-icon>
                            </span>
                            <span class="title">Add Drivers</span>
                        </a>
                    </li>                    

                    

                    <li>
                        <a href="../addroute/addroute.php">
                            <span class="icon">
                                <ion-icon name="location"></ion-icon>
                            </span>
                            <span class="title">Insert Routes</span>
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
                        <a href="../addfaculty/addfaculty.php">
                            <span class="icon">
                                <ion-icon name="book"></ion-icon>
                            </span>
                            <span class="title">Edit Faculty</span>
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
                      <h1>Bus Schedule</h1><br><br>
                        <div class="form-row">
                            <form action='addbus_enableall.php' method='POST'>
                              <button type='submit'>ENABLE ALL</button> 
                            </form>
                            <form action='addbus_disableall.php' method='POST'>
                                <button type='submit'>DISABLE ALL</button> 
                            </form>
                            <div style="clear:both;"></div> 
                        </div>
                        <br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Bus Role</th>
                                    <th>Seats</th>
                                    <th>Delete</th>
                                    <th>Disable</th>
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
                                            echo "<td>" . $row["role"] . "</td>";
                                            echo "<td>" . $row["seats"] . "</td>";
                                            echo "<td> 
                                            <input type='hidden' name='bus_id' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                            <input type='submit' value='DELETE' class='btton' onclick='validateForm1(this)' />                  
                                            </td>";
                                            if ($row["status"]=='true') {
                                                echo "<td>
                                                <form action='addbus_disable.php' method='POST'>
                                                <input type='hidden' name='busid' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                                <button type='submit'>DISABLE</button> 
                                                </form>                                    
                                                </td>";
                                                echo "</tr>";
                                            }
                                            else { 
                                                echo "<td>
                                                <form action='addbus_enable.php' method='POST'>
                                                <input type='hidden' name='busid' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                                <button type='submit'>ENABLE</button> 
                                                </form>                                    
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                ?>
                            </tbody>
                        </table><br>
                        <h1>Add a New Bus</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Bus Role</th> 
                                    <th>Seats</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" id="bid" name="bid" placeholder="Enter BUS ID" />
                                    </td>
                                    <td>
                                         <select id="rol" name="rol" style="width: 200px;">
                                         <option value="">Select Role</option>
                                         <option value="faculty">Faculty</option>
                                         <option value="student">Student</option>
                                         </select>
                                    </td>
                                    <td>
                                        <input type="number" id="seat" name="seat" placeholder="Enter Total Seats"/>
                                    </td>
                                    <td>
                                        <input type='submit' value='ADD' class='btton' onclick='validateForm()' /> 
                                    </td>
                                </tr>
                            </tbody>
                        </table><br>
                <p style="color:red" id="test" ></p>
                </div>
            </div>
        </div>
<script>
    function validateForm() {
        let bus_id = document.getElementById('bid').value;
        let role = document.getElementById('rol').value; 
        let seats = document.getElementById('seat').value;
        if(role=='faculty' || role=='student'){
            sendData(bus_id,role,seats);
            return true;
        }
        else{
            document.getElementById('test').innerHTML='Please select role';
            return false;
        }
        
    }  

    function sendData(bus_id,role,seats) {
        $.ajax({
            type: "POST",
            url: "addbus_add.php",
            data: { 
                bus_id:bus_id,
                role:role,
                seats:seats
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'bus_id'){
                    $('#test').html('This Bus is already in use please give another ID'); 
                }
                else if(response=='success'){
                    window.location.href = 'addbus.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }

function validateForm1(button) {
        let bid = button.parentNode.querySelector("#bus_id").value;
        sendData1(bid);
        return true;
    }  

    function sendData1(bid) {
        $.ajax({
            type: "POST",
            url: "addbus_delete.php",
            data: { 
                bus_id:bid
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'bus_id'){
                    $('#test').html('Bus is in use at present,can not be deleted'); 
                }
                else if(response=='success'){
                    window.location.href = 'addbus.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }

</script>
<script src="../assets/js/main.js"></script>

   </body>
</html>

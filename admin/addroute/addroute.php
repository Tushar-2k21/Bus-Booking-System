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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                        <a href="../addbus/addbus.php">
                            <span class="icon">
                                <ion-icon name="bus"></ion-icon>
                            </span>
                            <span class="title">Add Buses</span>
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
                      <h1>Route List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Route ID</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Departure From Source</th>
                                    <th>Departure From Destination</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT * FROM route";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["route_id"] . "</td>";
                                    echo "<td>" . $row["source"] . "</td>";
                                    echo "<td>" . $row["destination"] . "</td>";
                                    echo "<td>" . $row["departure_src"] . "</td>";
                                    echo "<td>" . $row["departure_dst"] . "</td>";
                                    echo "<td>
                                    <input type='hidden' name='route_id' value='" . $row["route_id"] . "' id = 'route_id' >
                                    <input type='submit' value='DELETE' class='btton' onclick='validateForm1(this)' /> 
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>
                    <h1>Add a New Route</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Route ID</th>
                                    <th>Starting Point</th>
                                    <th>Destination</th>
                                    <th>Departure From Source</th>
                                    <th>Departure From Destination</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" id="rid" name="rid" placeholder="Enter Route ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="src" name="src" placeholder="Enter Starting Point"/>
                                    </td>
                                    <td>
                                        <input type="text" id="dst" name="dst" placeholder="Enter Destination Point"/>
                                    </td>
                                    <td>
                                        <input type="time" id="dep_src" name="dep_src" placeholder="Enter Departure Time From Source"/>
                                    </td>
                                    <td>
                                        <input type="time"  id="dep_dst" name="dep_dst" placeholder="Enter Departure Time From Destination"/>
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
        let rid = document.getElementById('rid').value;
        let src = document.getElementById('src').value; 
        let dst = document.getElementById('dst').value;
        let dep_src = document.getElementById('dep_src').value;
        let dep_dst = document.getElementById('dep_dst').value;

        if(dep_src>=dep_dst){
             document.getElementById('test').innerHTML = 'Source departure timing should be less than destination departure timing';
return false;
        }
        sendData(rid,src,dst,dep_src,dep_dst);
        return true;
    }  

    function sendData(rid,src,dst,dep_src,dep_dst) {
        $.ajax({
            type: "POST",
            url: "addroute_add.php",
            data: { 
                route_id:rid,
                source:src,
                destination:dst,
                departure_src:dep_src,
                departure_dst:dep_dst 
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'route_id'){
                    $('#test').html('Route ID is already present provide another ID'); 
                } 
                else if(response=='success'){
                    window.location.href = 'addroute.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }

    function validateForm1(button) {
        let rid = button.parentNode.querySelector("#route_id").value;
        
        sendData1(rid);
        return true;
    }  

    function sendData1(rid) {
        $.ajax({
            type: "POST",
            url: "addroute_delete.php",
            data: { 
                route_id:rid
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'route_id'){
                    $('#test').html('Route ID is in use by buses,can not remove it'); 
                } 
                else if(response=='success'){
                    window.location.href = 'addroute.php';
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

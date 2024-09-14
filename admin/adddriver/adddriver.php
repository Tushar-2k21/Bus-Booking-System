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
                        <a href="../adddrives/adddrives.php">
                            <span class="icon">
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </span>
                            <span class="title">Assign</span>
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
                        <a href="../addstudent/addstudent.php">
                            <span class="icon">
                                <ion-icon name="school"></ion-icon>
                            </span>
                            <span class="title">Edit Students</span>
                        </a>
                    </li>  
                    <li>
                        <a href="../addroute/addroute.php">
                            <span class="icon">
                                <ion-icon name="location"></ion-icon>
                            </span>
                            <span class="title">Insert Route</span>
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
                      <h1>Driver List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Driver ID</th>
                                    
                                    <th>Phone</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM driver ";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["driver_id"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>
                                    <input type='hidden' name='driver_id' value='" . $row["driver_id"] . "' id = 'driver_id' >
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
                    <h1>Add a New Driver</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Driver ID</th>
                                    <th>Driver Name</th>
                                    <th>Phone</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" id="did" name="did" placeholder="Enter Driver ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="name" name="name" placeholder="Enter Driver Name"/>
                                    </td>
                                    <td>
                                        <input type="number" id="phone" name="phone" placeholder="Enter Phone number"/>
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
        let did = document.getElementById('did').value;
        let name = document.getElementById('name').value; 
        let phone = document.getElementById('phone').value;
        if(phone.length!=10){
            document.getElementById('test').innerHTML='Phone No. should of length 10';
            return false;
}
        sendData(did,name,phone);
        return true;
    }  

    function sendData(did,name,phone) {
        $.ajax({
            type: "POST",
            url: "adddriver_add.php",
            data: { 
                driver_id:did,
                name:name,
                phone:phone
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'driver_id'){
                    $('#test').html('Driver ID is already present provide another ID'); 
                }
                else if(response === 'phone'){
                    $('#test').html('Phone No. is already present, please give another number'); 
                }
                else if(response=='success'){
                    window.location.href = 'adddriver.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }


function validateForm1(button) {
        let did = button.parentNode.querySelector("#driver_id").value;
        sendData1(did);
        return true;
    }  

    function sendData1(did) {
        $.ajax({
            type: "POST",
            url: "adddriver_delete.php",
            data: { 
                driver_id:did
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'driver_id'){
                    $('#test').html('Driver is assinged to a bus at present,can not be deleted'); 
                }
                else if(response=='success'){
                    window.location.href = 'adddriver.php';
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


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
                      <h1>Student List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>student Name</th>
                                    <th>student ID</th>
                                    <th>email</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM student";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["student_id"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>
                                    <form action='addstudent_delete.php' method='POST'>
                                    <input type='hidden' name='student_id' value='" . $row["student_id"] . "' id = 'student_id' >
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
                </div>
            </div>
        </div>
   </body>
        <script src="../assets/js/main.js"></script>

</html>

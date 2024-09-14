<?php
    
include('connection.php');
session_start();
    $username = $_POST['user'];  
    $pass= $_POST['pass']; 
    if($username!='admin')$password =md5($pass);
    else $password=$pass; 
    $role = $_POST['role'];  
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
        
        

        $sql = "select * from student where student_id = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        $sql1 = "select * from faculty where faculty_id = '$username' and password = '$password'";  
        $result1 = mysqli_query($conn, $sql1);  
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
        $count1 = mysqli_num_rows($result1);  
  
        if($count == 1 && $role=='student'){     
            $_SESSION['loggedIn']=true;
            $_SESSION['usernow']=$username;
            $_SESSION['passnow']=$password;
            $_SESSION['displayname']=$row['name'];
            $_SESSION['role']='student';
            echo 'student'; 
            exit(); 
        }  
       
        if($count1 == 1 && $role=='faculty'){     
            $_SESSION['loggedIn']=true;
            $_SESSION['usernow']=$username;
            $_SESSION['passnow']=$password;
            $_SESSION['displayname']=$row1['name'];
            $_SESSION['role']='faculty';
            echo 'faculty';
            exit(); 
        }
        else if($username=="admin" AND $password=="admin@dbms21"){
            $_SESSION['usernow']=$username;
            $_SESSION['passnow']=$password;
            $_SESSION['displayname']='Ansh';
            $_SESSION['loggedIn']=true;
            echo 'admin';
            exit();
        }
        else{
            echo 'Invalid Username or Password';
            exit(); 
        }
?>

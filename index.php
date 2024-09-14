<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
      <meta http-equiv="X-UA-Compatible" content="ie-edge" />
            <link rel="stylesheet" href="signin/style.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <title>BusRide</title>
   </head>

   <body>

      <div class="container" id="container">
         <div class="form-container sign-up-container">
            <div class="f1">
               <h1>Faculty Sign In</h1>
               <br><br>
               <input type="text" id="user1" name="user1" placeholder="Email: example@iiita.ac.in"  style="border-top-left-radius:0.375rem; border-top-right-radius:0.375rem"/>
               <input type="password" id="pass1" name="pass1" placeholder="Password" autocomplete="off" style="border-bottom-left-radius:0.375rem; border-bottom-right-radius:0.375rem"/>
               <input type="hidden" id="role1" name="role1" value="faculty"/>
               <p style="color:red;" id="test1" ></p>
               <a href="faculty_forget/verify/verify.html">Forgot your password?</a>
               <input type="submit" id="btn" name="commit1" value="Sign In" onclick="validateForm1()" class="button"/>
               <p>New ? <a href="faculty_signup/verify/verify.html">Create an account</a></p>
            </div>
         </div>
         <div class="form-container sign-in-container">
            <div class="f1">
               <h1>Student Sign In</h1>
               <br><br>
               <input type="text" id="user" name="user" placeholder="User Name"  style="border-top-left-radius:0.375rem; border-top-right-radius:0.375rem"/>
               <input type="password" id="pass" name="pass" placeholder="Password" autocomplete="off" style="border-bottom-left-radius:0.375rem; border-bottom-right-radius:0.375rem" />
               <input type="hidden" id="role" name="role" value='student'/>
               <p style="color:red;" id="test"></p>
               <a href="student_forget/verify/verify.html">Forgot your password?</a>
               <input type="submit" id="btn" name="commit" value="Sign In" onclick="validateForm()" class="button"/>
               <p>New ? <a href="student_signup/verify/verify.html">Create an account</a></p>
            </div>
         </div>
         <div class="overlay-container">
            <div class="overlay">
               <div class="overlay-panel overlay-left">
                  <h1>Welcome Back!</h1>
                  <p>Login to ride with us</p>
                  <button class="button" id="signIn">Student</button>
               </div>
               <div class="overlay-panel overlay-right">
                  <h1>Welcome Back!</h1>
                  <p>Login to ride with us</p>
                  <button class="button" id="signUp">Faculty</button>
               </div>
            </div>
         </div>
      </div>
      <script src="signin/main.js"></script>
   </body>
</html>

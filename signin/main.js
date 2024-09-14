const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});



function isValidEmail(email) {
  // Check if the email ends with "iiita.ac.in"
  if (email.endsWith("iiita.ac.in")) {
    // Check if the email contains any numerical digits
    const hasNumericDigits = /\d/.test(email);
    return !hasNumericDigits;
  }
  return false;
}
function validateForm1() {
  
  let username = document.getElementById('user1').value;
  let password = document.getElementById('pass1').value;
  let role=document.getElementById('role1').value;
  console.log(username); 
  if (username.length!=0 && isValidEmail(username) || username=='admin') {
    if(password.length == 0){
      document.getElementById('test1').innerHTML = 'Enter Password';
      return false;
    }
    else{
      sendData1(username, password, role);
      return true;
    }
  } 
  else {
    document.getElementById('test1').innerHTML = 'Invalid Username';
    document.getElementById('user1').value = '';
    return false;
  }
}
function sendData1(username, password, role) {
  
    $.ajax({
        type: "POST",
        url: "../authentication/authentication.php",
        data: { 
            user:username,
            pass:password,
            role:role
        },
        success: function(data) { 
          data=data.trim();
          console.log(data);
          if(data === 'faculty' ){
            window.location.href = '../dash/index.php';
          }
          else if(data==='admin'){
             window.location.href = '../admin/adminindex.php';
          }
          else{
            $('#test1').html(data); 
            document.getElementById('pass1').value = '';
          }
        }
    });
}
function validateForm() {
  
  let username = document.getElementById('user').value;
  let password = document.getElementById('pass').value;
  let role=document.getElementById('role').value;
  const usernameRegex = new RegExp(
    /^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@iiita.ac.in/,
    'gm'
  );
  username=username.toLowerCase();
  if (username.length == 10 || usernameRegex.test(username) || username == 'admin') {
    if(password.length == 0){
      document.getElementById('test').innerHTML = 'Enter Password';
      return false;
    }
    else{
      sendData(username, password, role);
      return true;
    }
  } 
  else {
    document.getElementById('test').innerHTML = 'Invalid Username';
    document.getElementById('user').value = '';
    return false;
  }
}

function sendData(username, password, role) {
  
    $.ajax({
        type: "POST",
        url: "../authentication/authentication.php",
        data: { 
            user:username,
            pass:password,
            role:role
        },
        success: function(response) {
          response=response.trim();
          console.log(response);
          if(response === 'student'){
            window.location.href = '../dash/index.php';
          }
          else if(response=='admin'){
             window.location.href = '../admin/adminindex.php';
          }
          else{
            $('#test').html(response); 
            document.getElementById('pass').value = '';
          }
        }
    });
}

function isValidEmail(email) {
  // Check if the email ends with "iiita.ac.in"
  if (email.endsWith("iiita.ac.in")) {
    // Check if the email contains any numerical digits
    const hasNumericDigits = /\d/.test(email);
    return !hasNumericDigits;
  }
  return false;
}

function validateEmail(str) { 
  let button = document.getElementById('button');
  let test =  document.getElementById('test');
  button.disabled = true;
  console.log(str);
  if (str.length == 0 ) {
    test.removeAttribute('hidden');
    document.getElementById('test').innerHTML = 'Enter your email!';
     button.disabled = false;
    return;
  }
  if(!isValidEmail(str)){
      test.removeAttribute('hidden');
    document.getElementById('test').innerHTML = 'Invalid Email!';
     button.disabled = false;
    return;

  }
  else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        test.removeAttribute('hidden');
        document.getElementById('test').innerHTML = this.responseText;
        document.getElementById('email').value = '';
        button.disabled = false;
        return;
      }
    };

    xmlhttp.open('GET', 'verify.php?email=' + str, true);
    xmlhttp.send();
    
   }
}

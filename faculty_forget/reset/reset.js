function validateForm() {
  let pass = document.forms['reset']['pass'].value;
  let confirmpass = document.forms['reset']['repass'].value;
  let perror =  document.getElementById('password-error');
  let cerror =  document.getElementById('confirm-error'); 
console.log(pass);
console.log(confirmpass);
  const uppercaseRegex = /[A-Z]/;
  const lowercaseRegex = /[a-z]/;
  const numberRegex = /[0-9]/;
  const symbolRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
  
 
 
  if(uppercaseRegex.test(pass) && lowercaseRegex.test(pass) && symbolRegex.test(pass) &&
      numberRegex.test(pass) && pass.length >= 8){
    document.getElementById('password-error').innerHTML = '';

    if(pass===confirmpass){
      
      document.getElementById('confirm-error').innerHTML = '';
      return true;
    }
    else{
      cerror.removeAttribute('hidden');
      document.getElementById('confirm-error').innerHTML = 'Passwords do not match.';
      return false;
    }
  }
  else{
    perror.removeAttribute('hidden');
    document.getElementById('password-error').innerHTML = 'Password not strong enough';
    if(pass===confirmpass){
      
      document.getElementById('confirm-error').innerHTML = '';
      
    }
    else{
      cerror.removeAttribute('hidden');
      document.getElementById('confirm-error').innerHTML = 'Passwords do not match.';
          }

    return false;
  }
}

const infoBtn = document.getElementById("info-btn");
            const infoBox = document.getElementById("info-box");

            infoBtn.addEventListener("click", () => {
                infoBox.style.display = "block";
            });

            window.addEventListener("click", (event) => {
                if (!event.target.matches("#info-btn")) {
                    infoBox.style.display = "none";
                }
            });


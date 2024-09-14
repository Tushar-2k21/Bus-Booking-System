function validateForm() {
  let name = document.forms['signup']['name'].value;
  let pass = document.forms['signup']['pass'].value;
  let nerror =  document.getElementById('name-error');
  let perror =  document.getElementById('password-error');
  let cerror =  document.getElementById('confirm-error');
 

  let confirmpass = document.forms['signup']['repass'].value;


  const uppercaseRegex = /[A-Z]/;
  const lowercaseRegex = /[a-z]/;
  const numberRegex = /[0-9]/;
  const symbolRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
  
 
  if(name.length===0){
    nerror.removeAttribute('hidden');
    document.getElementById('name-error').innerHTML = 'Enter your name.';
    
  }
  else{
    document.getElementById('name-error').innerHTML = '';
  }

  

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

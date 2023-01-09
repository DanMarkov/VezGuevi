<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/sysSignUp.php";
require_once "$path/private/head.php";
?>

<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" enctype="multipart/form-data" id="form" method="POST">
      <h3>Sign Up Now!</h3>
      <span>
         <input type="text" name="name" class="box" id="login" required>
         <label for="login" class="input-label">enter your name</label>
      </span>
      <span>
         <input type="email" name="email" id="email" class="box" required  pattern="^([a-zA-Z0-9_\-\.]+)@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$">
         <label for="email" class="input-label">enter your email</label>
      </span>
      <span>
         <input type="password" name="pass" class="box" id="password" required>
         <label for="password" class="input-label">enter your password</label>
      </span>
      <span>
          <input type="password" name="cpass" class="box" id="password2" required>
         <label for="password2" class="input-label">confirm your password</label>
      </span>
      <span>
          <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png, image/gif">
      </span>
      <span class="btn-login invalid" id="submit"><input type="submit" value="Sign Up Now" class="submit" name="submit"></span>
      <p>already have an account? <a href="login">login now</a></p>
   </form>

</section>

<script>
   login.oninput = ()=>{
   if(login.value.length<3){
        console.log("Логин должен быть от 3 символов!");
        login.style.border = ".2rem solid red";
     
   }
   else{
       login.style.border = ".2rem solid green";
   }
}
password.oninput = ()=>{
   if(password.value.length<3){
        console.log("Логин должен быть от 3 символов!");
        password.style.border = ".2rem solid red";
     
   }
   else{
       password.style.border = ".2rem solid green";
   }
}
password2.oninput = ()=>{
   if(password.value!=password2.value){
       
        password2.style.border = ".2rem solid red";
     
   }
   else{
       password2.style.border = ".2rem solid green";
   }
}

const submit = document.getElementById("submit");
const form = document.getElementById("form");
form.addEventListener('keyup', () => isFormValid());
function isFormValid() {
   const login = document.forms.form.login.value;
   const email = document.forms.form.email.value;
   const pass = document.forms.form.pass.value;
   const cpass = document.forms.form.cpass.value;
   if (login !== '' && email !== '' && pass !== '' && cpass === pass) {
      removeInvalid();
   } else {
      addInvalid();
   }
}

function addInvalid() {
   submit.classList.add('invalid');
}

function removeInvalid() {
   submit.classList.remove('invalid');
   submit.classList.remove('left');
}

submit.addEventListener('mouseenter', () => moveButton());

let moved = true;

function moveButton() {
  if (submit.classList.contains('invalid')) {
    if (moved) {
      moved = false;
      submit.classList.add('left');
    } else {
      moved = true;
      submit.classList.remove('left');
    }
  }
}

</script>
</body>
</html>
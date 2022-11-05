<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/sysLogin.php";

session_start();
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

   <form action="" method="POST" id="form">
      <h3>login now</h3>
      <span>
         <input type="email" name="email" class="box" id="email" required>
         <label for="email" class="input-label">enter your email</label>
      </span>
      <span>
         <input type="password" name="pass" class="box" id="password" required>
         <label for="password" class="input-label">enter your password</label>
      </span> 
     
      <span class="btn-login invalid" id="submit"><input type="submit" value="Login Now" class="submit" name="submit" ></span>
      <p>don't have an account? <a href="/signup">sign up now!</a></p>
   </form>

</section>

<script>
   
const submit = document.getElementById("submit");
const form = document.getElementById("form");
form.addEventListener('keyup', () => isFormValid());
function isFormValid() {
   const email = document.forms.form.email.value;
   const pass = document.forms.form.pass.value;
   if (email !== '' && pass !== '') {
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
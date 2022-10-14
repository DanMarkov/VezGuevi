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

   <form action="" method="POST">
      <h3>login now</h3>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <span class="btn"><input type="submit" value="Login Now" class="submit" name="submit"></span>
      <p>don't have an account? <a href="/signup">sign up now!</a></p>
   </form>

</section>


</body>
</html>
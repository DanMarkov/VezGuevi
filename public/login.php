<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_UNSAFE_RAW);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_UNSAFE_RAW);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header("location:admin");

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header("location:home");

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

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
      <span class="btn"><input type="submit" value="login now" class="submit" name="submit"></span>
      <p>don't have an account? <a href="register">register now</a></p>
   </form>

</section>


</body>
</html>
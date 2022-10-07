<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_UNSAFE_RAW);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_UNSAFE_RAW);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_UNSAFE_RAW);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_UNSAFE_RAW);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_UNSAFE_RAW);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login');
            }
         }

      }
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

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <span class="btn"><input type="submit" value="register now" class="submit" name="submit"></span>
      <p>already have an account? <a href="login">login now</a></p>
   </form>

</section>


</body>
</html>
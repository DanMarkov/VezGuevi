<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

function clearValue($value) {
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['pass']);


   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = "$path/uploaded_img/".$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'Емейл пользователя уже существует';
   }else{
         $query = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(:name,:email,:password,:image)");
         $query->execute([
            ":name"=>clearValue($name),
            ":email"=>clearValue($email),
            "password"=>clearValue($pass),
            "image"=>clearValue($image)
         ]);

         if($query){
            if($image_size > 3000000){
               $message[] = 'Файл слишком большой!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'Регистрация прошла успешна!';
               header('location:login');
            }
         }

      }
   }

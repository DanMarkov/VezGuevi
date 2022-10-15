<?

    
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";


function clearValue($value){
        $value = trim($value);
        $value = htmlspecialchars($value);
        return $value;
    }

if(isset($_POST['submit'])){

$email = $_POST['email'];
$pass = md5($_POST['pass']);

$sql = "SELECT * FROM `users` WHERE email = :email AND password = :password";
$prepare = $conn->prepare($sql);
$prepare->execute([
":email" => clearValue($email), 
":password" => clearValue($pass)
]);
$rowCount = $prepare->rowCount();  

$row = $prepare->fetch(PDO::FETCH_ASSOC);

if($rowCount > 0){

   if($row['user_type'] == 'admin'){

      $_SESSION['admin_id'] = $row['id'];
      header("location:/admin");

   }elseif($row['user_type'] == 'user'){

      $_SESSION['user_id'] = $row['id'];
      header("location:/home");

   }else{
      $message[] = 'Пользователь не найден!';
   }

}else{
   $message[] = 'Неверный логин или пароль!';
}

}


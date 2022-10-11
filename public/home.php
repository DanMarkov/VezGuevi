<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_UNSAFE_RAW);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_UNSAFE_RAW);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_UNSAFE_RAW);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_UNSAFE_RAW);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_UNSAFE_RAW);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_UNSAFE_RAW);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_UNSAFE_RAW);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_UNSAFE_RAW);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_UNSAFE_RAW);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }

}

require_once "$path/private/head.php";
?>

<body>
   
<?php require_once "$path/private/header.php"; ?>

<div class="home-bg">

   <video autoplay loop muted plays-inline class="video-bg" id="video" src="../images/video">
      <source type="video/mp4" >
   </video>
   <section class="home">
      
      <div class="content">
         <span>Ништяково</span>
         <h3>САМЫЕ КРУТЫЕ ТОВАРЫ!</h3>
         <p>ПРОСТО КЛАСС!</p>
         <a href="shop" class="btn">к покупкам!</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">Категории</h1>

   <div class="box-container">

      <div class="box">
         <img src="../images/shibaquest_tee_200x.png" alt="siba_quest">
         <h3>tops</h3>
         <p>VaporTEK Top, Graphic Tees, Long Sleeve Graphic Tees, Graphic Sweatshirts,
            Graphic Sweatshirts, Hawaiian Shirts, All Over Print Tees, All Over Print Hoodies,
            All Over Print Sweatshirts, All Over Print Zip Up, Tank Tops, Bomber Jackets;
         </p>
         <a href="category?category=tops" class="btn">Смотреть</a>
      </div>

      <div class="box">
         <img src="../images/cloakanddagger_200x.png" alt="">
         <h3>Bottoms</h3>
         <p>VaporTEK Shorts, Joggers, Shorts, Swim Trunks, Shoes</p>
         <a href="category?category=bottoms" class="btn">Смотреть</a>
      </div>

      <div class="box">
         <img src="../images/Yogasetmockuptopfront_200x.png" alt="">
         <h3>Womens</h3>
         <p>VaporTEK Collection, Crop Tops, High Legged One Piece Swimsuits</p>
         <a href="category?category=womens" class="btn">Смотреть</a>
      </div>

      <div class="box">
         <img src="../images/facemask_samurai_new_front_200x.png" alt="">
         <h3>Accessories</h3>
         <p>Bucket Hats, Face Masks, Hats, Phone Cases, Pins, Beach Towels, </p>
         <a href="category?category=accessories" class="btn">Смотреть</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Последние товары</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <span class="option-btn"><input type="submit" value="add to wishlist" class="submit" name="add_to_wishlist"></span> 
      <span class="btn"><input type="submit" value="add to cart" class="submit" name="add_to_cart"></span>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>







<?php require_once "$path/private/footer.php"; ?>
<script>
   let video = document.getElementById('video');
   let number = Math.floor(Math.random() * 10) + 1;
   video.src += number + '.mp4';

</script>

<script src="../js/script.js"></script>

</body>
</html>
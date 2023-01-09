<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login');
};

function clearValue($value) {
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
}

if(isset($_POST['add_to_cart'])){

   $pid = clearValue($_POST['pid']);
   $p_name = clearValue($_POST['p_name']);
   $p_price = clearValue($_POST['p_price']);
   $p_image = clearValue($_POST['p_image']);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to cart!';
   }

}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/header.php"; ?>

<section class="p-category">

   <a href="category?category=tops">tops</a>
   <a href="category?category=bottoms">Bottoms</a>
   <a href="category?category=womens">Womens</a>
   <a href="category?category=accessories">Accessories</a>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <a href="view?pid=<?= $fetch_products['id']; ?>" >
      <form action="" class="box" method="POST">
         <div class="img">
            <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="product">
         </div>
         <div class="box-details">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="details"><?= $fetch_products['details']; ?></div>
         </div>
         <div class="price">
            <div class="price_num">$<span><?= $fetch_products['price']; ?></span></div>
         </div>
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
         <span class="btn"><svg class="theme-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.84052 11.5652H43.4958C43.79 11.5652 44.0802 11.6329 44.3439 11.7633C44.6076 11.8936 44.8377 12.0831 45.0163 12.3168C45.1949 12.5506 45.3172 12.8223 45.3737 13.111C45.4301 13.3997 45.4193 13.6976 45.3419 13.9814L41.4144 28.379C41.0833 29.5936 40.362 30.6657 39.3615 31.4301C38.3611 32.1944 37.1371 32.6085 35.8781 32.6087H12.2711" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M2 2H2.72313C3.60097 2.00005 4.45209 2.30195 5.13375 2.85508C5.8154 3.4082 6.28612 4.1789 6.46696 5.03791L12.8393 35.3099C13.0201 36.1689 13.4909 36.9396 14.1725 37.4927C14.8542 38.0459 15.7053 38.3478 16.5831 38.3478H38.3478" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M12.5217 43.1304C12.5217 43.8915 12.8241 44.6214 13.3622 45.1595C13.9004 45.6977 14.6302 46 15.3913 46C16.1523 46 16.8822 45.6977 17.4204 45.1595C17.9585 44.6214 18.2609 43.8915 18.2609 43.1304C18.2609 42.3694 17.9585 41.6395 17.4204 41.1013C16.8822 40.5632 16.1523 40.2609 15.3913 40.2609C14.6302 40.2609 13.9004 40.5632 13.3622 41.1013C12.8241 41.6395 12.5217 42.3694 12.5217 43.1304V43.1304Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M31.6522 43.1304C31.6522 43.8915 31.9545 44.6214 32.4926 45.1595C33.0308 45.6977 33.7607 46 34.5217 46C35.2828 46 36.0127 45.6977 36.5508 45.1595C37.089 44.6214 37.3913 43.8915 37.3913 43.1304C37.3913 42.3694 37.089 41.6395 36.5508 41.1013C36.0127 40.5632 35.2828 40.2609 34.5217 40.2609C33.7607 40.2609 33.0308 40.5632 32.4926 41.1013C31.9545 41.6395 31.6522 42.3694 31.6522 43.1304V43.1304Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg><input type="submit" value="add to cart" class="submit" name="add_to_cart"></span>
      </form>
   </a>
      <?php 
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>








<? require_once "$path/private/footer.php"; ?>

<script src="../js/script.js"></script>

</body>
</html>
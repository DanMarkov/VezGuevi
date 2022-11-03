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
   $p_qty = clearValue($_POST['p_qty']);

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

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$delete_id]);
   header('location:wishlist');

}

if(isset($_GET['delete_all'])){

   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist');

}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/header.php"; ?>

<section class="wishlist">

   <h1 class="title">products added</h1>

   <div class="box-container">

<?php
   $grand_total = 0;
   $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
   $select_wishlist->execute([$user_id]);
   if($select_wishlist->rowCount() > 0){
      while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){ 
?>
   <form action="" method="POST" class="box">
      <a href="wishlist?delete=<?= $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
      <img src="../uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="product image">
      <div class="name"><?= $fetch_wishlist['name']; ?></div>
      <div class="price">$<?= $fetch_wishlist['price']; ?></div>
      <input type="number" min="1" value="1" class="qty" name="p_qty">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
      <span class="btn"><input type="submit" class="submit" value="add to cart" name="add_to_cart" ></span>
   </form>

<?php
   $grand_total += $fetch_wishlist['price'];
   }
}else{
   echo '<p class="empty">your wishlist is empty</p>';
}
?>
</div>

   <!-- <div class="box-container">

   <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if($select_wishlist->rowCount() > 0){
         while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="wishlist?delete=<?= $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
      <a href="view?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
      <div class="name"><?= $fetch_wishlist['name']; ?></div>
      <div class="price">$<?= $fetch_wishlist['price']; ?></div>
      <input type="number" min="1" value="1" class="qty" name="p_qty">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
      <span class="btn"><input type="submit" class="submit" value="add to cart" name="add_to_cart" ></span>
   </form>
   <?php
      $grand_total += $fetch_wishlist['price'];
      }
   }else{
      echo '<p class="empty">your wishlist is empty</p>';
   }
   ?>
   </div> -->

   <div class="wishlist-total">
      <p>grand total: <span>$<?= $grand_total; ?></span></p>
      <a href="shop" class="option-btn">continue shopping</a>
      <a href="wishlist?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
   </div>

</section>








<? require_once "$path/private/footer.php"; ?>

<script src="../js/script.js"></script>

</body>
</html>
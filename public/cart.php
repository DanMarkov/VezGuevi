<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();

$user_id = $_SESSION['user_id'];

function clearValue($value) {
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
}

if(!isset($user_id)){
   header('location:login');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$delete_id]);
   header('location:cart');
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart');
}


if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty = clearValue($_POST['p_qty']);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$p_qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/header.php"; ?>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="cart?delete=<?= $fetch_cart['id'];?>" onclick="return confirm('delete this from cart?');"> 
         <svg class="theme-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg>
      </a>
      <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="price">$<?= $fetch_cart['price']; ?></div>
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <div class="flex-btn">
         <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
         <span class="option-btn"><input type="submit" value="update" name="update_qty" class="submit"></span>
      </div>
      <div class="sub-total"> sub total: <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
   </form>
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>grand total: <span>$<?= $grand_total; ?></span></p>
      <a href="shop" class="option-btn">continue shopping</a>
      <a href="cart?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
      <a href="checkout" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>

<? require_once "$path/private/footer.php"; ?>

<script src="../js/script.js"></script>

</body>
</html>
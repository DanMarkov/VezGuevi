<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:/login');
};

function clearValue($value) {
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
}

if(isset($_POST['add_product'])){

   $name = clearValue($_POST['name']);
   $price = clearValue($_POST['price']);
   $category = clearValue($_POST['category']);
   $details = clearValue($_POST['details']);

   $image = clearValue($_FILES['image']['name']);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = "$path/uploaded_img/".$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $category, $details, $price, $image]);

      if($insert_products){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_products.php');


}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/admin_header.php"; ?>

<section class="add-products">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>
                <input type="text" name="name" id="name" class="box" required>
                <label for="name" class="input-label">enter product name</label>
            </span>
           
            <select name="category" class="box" required>
               <option value="" selected disabled>select category</option>
               <option value="tops">tops</option>
               <option value="bottoms">bottoms</option>
               <option value="womens">womens</option>
               <option value="accessories">accessories</option>
            </select>
         </div>
         <div class="inputBox">
            <span>
               <input type="number" min="0" name="price" class="box" id="price" required>
               <label for="price" class="input-label">enter product price</label>
            </span>
            <span>
                <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png, image/gif">
            </span>
         </div>
      </div>
      <span>
         <textarea name="details" class="box" id="details" required cols="30" rows="10"></textarea>
         <label for="details" class="input-label">enter product details</label>
      </span>
      <span class="btn"><input type="submit" class="submit" value="add product" name="add_product"></span>
   </form>

</section>

<section class="show-products">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <div class="img">
         <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="product">
      </div>
      <div class="box-details">
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="cat"><?= $fetch_products['category']; ?></div>
         <div class="details"><?= $fetch_products['details']; ?></div>
      </div>
      <div class="price">
         <div class="price_num">$<span><?= $fetch_products['price']; ?></span></div>
      </div>
      <div class="flex-btn">
         <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   
   <?php
      }
   }else{
      echo '<p class="empty">now products added yet!</p>';
   }
   ?>

   </div>

</section>











<script src="../js/script.js"></script>

</body>
</html>
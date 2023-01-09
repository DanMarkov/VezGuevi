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

if(isset($_POST['update_product'])){

   $pid = $_POST['pid'];
   $name = clearValue($_POST['name']);
   $price = clearValue($_POST['price']);
   $category = clearValue($_POST['category']);
   $details = clearValue($_POST['details']);

   $image = clearValue($_FILES['image']['name']);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = "$path/uploaded_img/".$image;
   $old_image = $_POST['old_image'];

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, details = ?, price = ? WHERE id = ?");
   $update_product->execute([$name, $category, $details, $price, $pid]);

   $message[] = 'product updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{

         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink("$path/uploaded_img/".$old_image);
            $message[] = 'image updated successfully!';
         }
      }
   }

}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/admin_header.php"; ?>



<section class="update-product">

   <h1 class="title">update product</h1>   

   <div class="grid-form">
      <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt=""> 
      <span>
         <input type="text" name="name" id="name" required class="box" value="<?= $fetch_products['name']; ?>">
         <label for="name" class="input-label">enter product name</label>
      </span>
      <span>
         <input type="number" name="price" id="price" min="0" required class="box" value="<?= $fetch_products['price']; ?>">
         <label for="price" class="input-label">enter product price</label>
      </span>
      
      <select name="category" class="box" required>
         <option selected><?= $fetch_products['category']; ?></option>
         <option value="tops">tops</option>
         <option value="bottoms">bottoms</option>
            <option value="womens">womens</option>
            <option value="accessories">accessories</option>
         </select>
         <span>
            <textarea name="details" id="details" required class="box" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
            <label for="details" class="input-label">enter product details</label>
         </span>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/gif">
         <div class="flex-btn">
            <span class="btn"><input type="submit" class="submit" value="update product" name="update_product"></span>
            <a href="admin_products.php" class="option-btn">go back</a>
         </div>
      </form>
   </div>

   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>













<script src="../js/script.js"></script>

</body>
</html>
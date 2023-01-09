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

if(isset($_POST['order'])){

   $name = clearValue($_POST['name']);
   $number = clearValue($_POST['number']);
   $email = clearValue($_POST['email']);
   $method = clearValue($_POST['method']);
   $address = 'Address: '. $_POST['address'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['zip_code'];
   $address = clearValue($address);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'order placed already!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order placed successfully!';
   }

}

require_once "$path/private/head.php";
?>

<body>
   
<? require_once "$path/private/header.php"; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= '$'.$fetch_cart_items['price'].' x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   ?>
   <p>Total: <span>$<?= $cart_grand_total; ?></span></p>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <div class="flex">
         <div class="left">
            <h3>BILLING ADDRESS</h3>
            <div class="inputBox">
               <span>Full Name</span>
               <input type="text" name="name" placeholder="enter your name" class="box" required>
            </div>

            <div class="inputBox">
               <span>Your Email</span>
               <input type="email" name="email" placeholder="enter your email" class="box" required>
            </div>

            <div class="inputBox">
               <span>Your Address</span>
               <input type="text" name="address" placeholder="enter your address" class="box" required>
            </div>

            <div class="inputBox">
               <span>Your Country</span>
               <select name="country" class="box" id="country" required>
                  <option value="0">Countries</option>
               </select>
            </div>

            <div class="inputBox">
               <span>State</span>
               <select name="state" class="box" id="state" required>
                  <option value="0">States</option>
               </select>
            </div>

            <div class="inputBox">
               <span>City</span>
               <select name="city" class="box" id="city" required>
                  <option value="0">Cities</option>
               </select>
            </div>

            <div class="country">
               <div class="inputBox">
                  <span>ZIP Code</span>
                  <input type="number" min="0" name="zip_code" placeholder="enter your zip code" class="box" required>
               </div>
            </div>
         </div>
         <div class="right">
            <h3>PAYMENT</h3>
            <div class="inputBox">
               <span>Your Card Number or Cryptocurrency Address</span>
               <input type="number" name="number" placeholder="enter your card number" class="box" required>
            </div>

            <div class="inputBox">
               <span>Payment Method</span>
               <select name="method" class="box" id="method" required>
                  <option value="0">Payment Methods</option>
               </select>
            </div>



            <span class="btn"><input type="submit" name="order" class="submit" <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="SUBMIT!"></span>
         </div>
      </div>

   </form>

</section>








<? require_once "$path/private/footer.php"; ?>

<script src="../js/script.js"></script>
<script>
   function addOption(parent, content, value) {
      const newOption = document.createElement("option");
      newOption.innerHTML = content;
      newOption.setAttribute("value",value);
      parent.append(newOption);
   }

   fetch('/getMoney')
   .then(response => response.json())
   .then(data => {
      for(let value of data) {
         addOption(method, value.name, value.id);
      }
   });

   fetch('/getCountry')
   .then(response => response.json())
   .then(data => {      
         for(let value of data) {
            addOption(country, value.name, value.id);
         }
      });

      country.onchange = () => {
         fetch('/getState', {
            method: 'post',
            headers: {
               "content-type":"application/x-www-form-urlencoded;charset=UTF-8"
            },
            body: `country_id=${country.value}`
         })
         .then(response => response.json())
         .then(data => {
               state.innerHTML = null;
               city.innerHTML = null;
               addOption(state, "States", 0);
               addOption(city, "Cities", 0);
               for(let value of data) {
                  addOption(state, value.name, value.id);
               }
         });
      }

      state.onchange = () => {
         fetch('/getCity', {
            method: 'post',
            headers: {
               "content-type":"application/x-www-form-urlencoded;charset=UTF-8"
            },
            body: `state_id=${state.value}`
         })
         .then(response => response.json())
         .then(data => {
            console.log(data)
               city.innerHTML = null;
               addOption(city, "Cities", 0);
               for(let value of data) {
                  addOption(city, value.name, value.id);
               }
         });
      }

</script>
</body>
</html>
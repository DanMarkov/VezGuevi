<?php
$path = $_SERVER['DOCUMENT_ROOT'];

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <svg class="theme-icon" onclick="this.parentElement.remove();" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg>
      </div>
      ';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$delete_id]);
   header('location: home');
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location: home');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty = clearValue($_POST['p_qty']);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$p_qty, $cart_id]);
   $message[] = 'cart quantity updated';
}



?>

<header class="header">

   <div class="flex">

      <a href="/home" class="logo"><img src="../images/VH.gif" alt="logo"></a>

      <nav class="navbar">
         <div class="grid-for-svg">
            <svg class="theme-icon" id="close-btn" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
               <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
         </div>
         <a class="navbar-home" href="home">home</a>
         <a class="navbar-shop" href="shop">shop</a>
         <a class="navbar-orders" href="orders">orders</a>
         <a class="navbar-search" href="search">search!</a>
      </nav>

      <div class="icons">
         <svg class="theme-icon" id="menu-btn" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M46 40H2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M46 24H2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M46 8H2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg>
         <svg class="theme-icon" id="user-btn" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.1628 13.2558C13.1628 16.241 14.3487 19.104 16.4595 21.2149C18.5704 23.3258 21.4334 24.5116 24.4186 24.5116C27.4038 24.5116 30.2668 23.3258 32.3777 21.2149C34.4885 19.104 35.6744 16.241 35.6744 13.2558C35.6744 10.2706 34.4885 7.40763 32.3777 5.29675C30.2668 3.18588 27.4038 2 24.4186 2C21.4334 2 18.5704 3.18588 16.4595 5.29675C14.3487 7.40763 13.1628 10.2706 13.1628 13.2558V13.2558Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M6 46C6 41.1151 7.94053 36.4302 11.3947 32.9761C14.8488 29.5219 19.5337 27.5814 24.4186 27.5814C29.3035 27.5814 33.9884 29.5219 37.4425 32.9761C40.8967 36.4302 42.8372 41.1151 42.8372 46H6Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg>
         <a href="search" class="search-icon" ><svg class="theme-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 21.1304C2 26.2041 4.01552 31.07 7.60317 34.6577C11.1908 38.2453 16.0567 40.2609 21.1304 40.2609C26.2041 40.2609 31.07 38.2453 34.6577 34.6577C38.2453 31.07 40.2609 26.2041 40.2609 21.1304C40.2609 16.0567 38.2453 11.1908 34.6577 7.60317C31.07 4.01552 26.2041 2 21.1304 2C16.0567 2 11.1908 4.01552 7.60317 7.60317C4.01552 11.1908 2 16.0567 2 21.1304V21.1304Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M46 46L34.6576 34.6576" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
         </svg></a>
         <div id="mySideCart" class="side-cart">
            <svg class="theme-icon closebtn" onclick="closeNav()" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
               <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            
            <section class="shopping-cart">

               <h1 class="title">your cart</h1>

               <div class="box-container">
                  <div class="wrapper">
                     <?php
                        $grand_total = 0;
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if($select_cart->rowCount() > 0){
                           while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
                     ?>
                     <form action="" method="POST" class="box">
                        <div class="product">
                           <a href="cart?delete=<?= $fetch_cart['id'];?>" onclick="return confirm('delete this from cart?');"> 
                              <svg class="theme-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                 <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                           </a>
                           <div class="image-background">
                              <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                           </div>
                           <div class="content-background">
                              <div class="name"><?= $fetch_cart['name']; ?></div>
                              <div class="sub-total"> sub total: <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
                              <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                              <div class="flex-btn">
                                 <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
                                 <span class="option-btn"><input type="submit" value="update" name="update_qty" class="submit"></span>
                              </div>
                           </div> 
                        </div>
                     </form>
                     <?php
                        $grand_total += $sub_total;
                        }
                     }else{
                        echo '<p class="empty">your cart is empty</p>';
                     }
                     ?>
                  </div>
                
               </div>

               <div class="cart-total">
                  <p>grand total: <span>$<?= $grand_total; ?></span></p>
                  <a href="cart?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
                  <a href="checkout" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
               </div>

            </section>
         </div>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
         ?>
         <div href="cart" class="cart" onclick="openNav()" ><svg class="theme-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.84052 11.5652H43.4958C43.79 11.5652 44.0802 11.6329 44.3439 11.7633C44.6076 11.8936 44.8377 12.0831 45.0163 12.3168C45.1949 12.5506 45.3172 12.8223 45.3737 13.111C45.4301 13.3997 45.4193 13.6976 45.3419 13.9814L41.4144 28.379C41.0833 29.5936 40.362 30.6657 39.3615 31.4301C38.3611 32.1944 37.1371 32.6085 35.8781 32.6087H12.2711" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M2 2H2.72313C3.60097 2.00005 4.45209 2.30195 5.13375 2.85508C5.8154 3.4082 6.28612 4.1789 6.46696 5.03791L12.8393 35.3099C13.0201 36.1689 13.4909 36.9396 14.1725 37.4927C14.8542 38.0459 15.7053 38.3478 16.5831 38.3478H38.3478" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M12.5217 43.1304C12.5217 43.8915 12.8241 44.6214 13.3622 45.1595C13.9004 45.6977 14.6302 46 15.3913 46C16.1523 46 16.8822 45.6977 17.4204 45.1595C17.9585 44.6214 18.2609 43.8915 18.2609 43.1304C18.2609 42.3694 17.9585 41.6395 17.4204 41.1013C16.8822 40.5632 16.1523 40.2609 15.3913 40.2609C14.6302 40.2609 13.9004 40.5632 13.3622 41.1013C12.8241 41.6395 12.5217 42.3694 12.5217 43.1304V43.1304Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M31.6522 43.1304C31.6522 43.8915 31.9545 44.6214 32.4926 45.1595C33.0308 45.6977 33.7607 46 34.5217 46C35.2828 46 36.0127 45.6977 36.5508 45.1595C37.089 44.6214 37.3913 43.8915 37.3913 43.1304C37.3913 42.3694 37.089 41.6395 36.5508 41.1013C36.0127 40.5632 35.2828 40.2609 34.5217 40.2609C33.7607 40.2609 33.0308 40.5632 32.4926 41.1013C31.9545 41.6395 31.6522 42.3694 31.6522 43.1304V43.1304Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg><span><?= $count_cart_items->rowCount(); ?></span>
         </div>
      
      </div>




      <div class="profile">
         <div class="profile-detail">
            <?php
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->execute([$user_id]);
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
           
            <p><?= $fetch_profile['name']; ?></p>
         </div>
         <hr>
         <a href="update" class="btn">update profile</a>
         <a href="../system/logout.php" class="delete-btn">logout</a>
      </div>


   </div>

</header>

<script>
function openNav() {
   function mediaQuery(width) {
      if (width.matches) {
         document.getElementById("mySideCart").style.width = "100%";
      } else {
         document.getElementById("mySideCart").style.width = "62%";
      
      }
   }
   let width = window.matchMedia("(max-width: 806px)");
   mediaQuery(width);
   width.addListiner(mediaQuery);
}

function closeNav() {
  document.getElementById("mySideCart").style.width = "0";
}

</script>
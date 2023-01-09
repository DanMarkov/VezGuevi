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


?>

<header class="header">

   <div class="flex">

      <a href="../publicAdmin/admin_page.php" class="logo"><img src="../images/admin_logo.png" alt="logo"></a>

      <nav class="navbar">
         <div class="grid-for-svg">
            <svg class="theme-icon" id="close-btn" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M46 2L2 46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
               <path d="M46 46L2 2" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
         </div>
         <a class="navbar-home" href="../publicAdmin/admin_page.php">home</a>
         <a class="navbar-shop" href="../publicAdmin/admin_products.php">products</a>
         <a class="navbar-orders" href="../publicAdmin/admin_orders.php">orders</a>
         <a class="navbar-search" href="../publicAdmin/admin_users.php">users</a>
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
      </div>

      <div class="profile">
         <div class="profile-detail">
            <?php
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->execute([$admin_id]);
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>

         </div>
         <hr>
         <a href="../publicAdmin/admin_update_profile.php" class="btn">update profile</a>
         <a href="../system/logout.php" class="delete-btn">logout</a>
      </div>

   </div>

</header>
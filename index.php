<?
$path = $_SERVER['DOCUMENT_ROOT'];
require "$path/system/config.php";
//session_start();

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
if(@$_SERVER['REDIRECT_URL']=="" or @$_SERVER['REDIRECT_URL']=="/home"):
     require_once "$path/public/home.php";

elseif($_SERVER['REDIRECT_URL']=="/login"):
     require_once "$path/public/login.php";

elseif($_SERVER['REDIRECT_URL']=="/signup"):
     require_once "$path/public/signup.php";
       
elseif($_SERVER['REDIRECT_URL']=="/about"):
     require_once "$path/public/about.php";
       
elseif($_SERVER['REDIRECT_URL']=="/category"):
     require_once "$path/public/category.php";
       
elseif($_SERVER['REDIRECT_URL']=="/checkout"):
     require_once "$path/public/checkout.php";
       
elseif($_SERVER['REDIRECT_URL']=="/orders"):
     require_once "$path/public/orders.php";
       
elseif($_SERVER['REDIRECT_URL']=="/shop"):
     require_once "$path/public/shop.php";
       
elseif($_SERVER['REDIRECT_URL']=="/wishlist"):
     require_once "$path/public/wishlist.php";
       
elseif($_SERVER['REDIRECT_URL']=="/search"):
     require_once "$path/public/search_page.php";

elseif($_SERVER['REDIRECT_URL']=="/cart"):
     require_once "$path/public/cart.php";

elseif($_SERVER['REDIRECT_URL']=="/update"):
     require_once "$path/public/user_profile_update.php";

elseif($_SERVER['REDIRECT_URL']=="/contact"):
     require_once "$path/public/contact.php";

elseif($_SERVER['REDIRECT_URL']=="/admin"):
     require_once "$path/publicAdmin/admin_page.php";
else:
     require_once "$path/public/404.php";
endif;


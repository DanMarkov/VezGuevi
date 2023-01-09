<?
$path = $_SERVER['DOCUMENT_ROOT'];
require "$path/system/config.php";

if(@$_SERVER['REDIRECT_URL']=="" or @$_SERVER['REDIRECT_URL']=="/home"):
     require_once "$path/public/home.php";

elseif($_SERVER['REDIRECT_URL']=="/login"):
     require_once "$path/public/login.php";

elseif($_SERVER['REDIRECT_URL']=="/signup"):
     require_once "$path/public/signup.php";
              
elseif($_SERVER['REDIRECT_URL']=="/category"):
     require_once "$path/public/category.php";
       
elseif($_SERVER['REDIRECT_URL']=="/checkout"):
     require_once "$path/public/checkout.php";
       
elseif($_SERVER['REDIRECT_URL']=="/orders"):
     require_once "$path/public/orders.php";
       
elseif($_SERVER['REDIRECT_URL']=="/shop"):
     require_once "$path/public/shop.php";
        
elseif($_SERVER['REDIRECT_URL']=="/search"):
     require_once "$path/public/search_page.php";

elseif($_SERVER['REDIRECT_URL']=="/cart"):
     require_once "$path/public/cart.php";

elseif($_SERVER['REDIRECT_URL']=="/update"):
     require_once "$path/public/user_profile_update.php";

elseif($_SERVER['REDIRECT_URL']=="/view"):
     require_once "$path/public/view_page.php";

elseif($_SERVER['REDIRECT_URL']=="/admin"):
     require_once "$path/publicAdmin/admin_page.php";

elseif($_SERVER['REDIRECT_URL']=="/getMoney"):
     $queryMethod = $conn -> query("SELECT * FROM Methods");
     $arrMethods = $queryMethod -> fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($arrMethods);
elseif($_SERVER['REDIRECT_URL']=="/getCountry"):
     $queryCountry = $conn -> query("SELECT * FROM Countries ORDER BY name");
     $arrCountries = $queryCountry -> fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($arrCountries);
elseif($_SERVER['REDIRECT_URL']=="/getState"):
     $queryState = $conn -> query("SELECT * FROM States WHERE country_id = {$_POST['country_id']} ORDER BY name");
     $arrStates = $queryState -> fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($arrStates);
elseif($_SERVER['REDIRECT_URL']=="/getCity"):
     $queryCity = $conn -> query("SELECT * FROM Cities WHERE state_id = {$_POST['state_id']} ORDER BY name");
     $arrCities = $queryCity -> fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($arrCities);
else:
     require_once "$path/public/404.php";
endif;


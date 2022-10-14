<?
$path = $_SERVER['DOCUMENT_ROOT'];
require "$path/system/db.php";

if(isset($_GET['searchInput'])){
    // поиск по категориям
   $query =  $db -> prepare("SELECT * FROM category WHERE name  LIKE '$_GET[searchInput]%' ");
   $query -> execute();
   
   if($query -> rowCount() > 0){
       echo "<h3> Поиск по категориям </h3>";
   }
   foreach($query as $row){
       echo "<a href = '/search?cat=$row[id]'> $row[name] </a> <br>";
   }


    // поиск по тов.
   $queryGoods =  $db -> prepare("SELECT * FROM goods WHERE name  LIKE '%$_GET[searchInput]%' ");
   $queryGoods -> execute();
   
   if($queryGoods -> rowCount() > 0){
       echo "<h3> Поиск по товарам </h3>";
   }
   foreach($queryGoods as $rowGoods){
      


       echo <<<html
            <div class="productCard" data-product-id='$rowGoods[id]'>
                <div  class="productCard__img"> img </div>
                <div  class="productCard__cont">
                    <div class="productCard__cont_r1">
                        <div><a href="/cardProduct"> $rowGoods[name] </a> </div>
                    </div>
                    <div class="productCard__cont_r2" >
                        text text text
                    </div>
                    <div class="productCard__cont_r3">
                        <div class="productCard__cont__fav" data-to-fav='1'> x </div>
                        <div class="productCard__cont__price"> $rowGoods[price] </div>
                        <div class="productCard__cont__cart" data-to-cart='1' > addToCart </div>
                    </div>
                </div>
            </div>
            
       html;


   }

}

if(isset($_GET['cat'])){
    $queryCat =  $db -> prepare("SELECT * FROM goods WHERE cat_id = $_GET[cat] ");
    $queryCat -> execute();

    echo "<h3> Кат. </h3>";
    foreach($queryCat as $rowCat){
        echo "$rowCat[name] <br>";
    }

}

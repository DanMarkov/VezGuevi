<?
$dbHost = "localhost";
$dbName = "vez_guevi";
$dbUsername = "root";
$dbPassword = "";
session_start();
//MySQL 
try{
    $conn = new PDO("mysql:dbhost=$dbHost;dbname=$dbName",$dbUsername,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    
}
catch(Exception $e){
    echo "Ошибка подключения к MySQL: <br> $e";
}

// ReadBeanPhp
try{
    require_once "rb.php";
    R::setup("mysql:host=$dbHost;dbname=$dbName",$dbUsername,$dbPassword);
  
}
catch(Exception $e){

}

?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/config.php";

session_start();
session_unset();
session_destroy();

header('location:/login');

?>
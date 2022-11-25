
<?php 
require('config.php');
session_start(); 
session_destroy(); 
setcookie('cookie_id', '', time()-3600);
header('location:login.php'); 
?>
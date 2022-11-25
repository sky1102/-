<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'isa86118';
$db_name = 'db_13';

$cookie_id = $_COOKIE['cookie_id'];
if($cookie_id == null)
{
    echo "<script>alert('請先登入!!!'); location.href = 'login.php';</script>";
}

?>
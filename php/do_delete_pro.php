<html>
<head>
    <title>咖啡豆產銷資訊系統</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
    *{
        font-family: 微軟正黑體;
    }
</style>
<body>  
<?php

// ******** update your personal settings ******** 
require('config.php');

// Connecting to and selecting a MySQL database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$pro_ID = $_GET['id'];

if (isset($pro_ID)) {

    $delete_sql = "UPDATE product set del=0 WHERE product_ID='{$pro_ID}' "; 
    $delete_contain = "DELETE from contain where product_ID = $pro_ID ";
    $go = "shop_com.php";
	if ($conn->query($delete_contain) === TRUE) {
        if($conn->query($delete_sql) === TRUE)
        {
            echo "<script language='javascript'>alert('刪除成功!'); location.href='".$go."'</script>";
        }
        else echo "<script language='javascript'>alert('刪除失敗!'); window.history.back(-1); </script>";
    }else{
        echo "<script language='javascript'>alert('刪除失敗!'); window.history.back(-1); </script>";
	}

}else{
	echo "<script language='javascript'>alert('資料不完全!'); window.history.back(-1);</script>";
}
				
?>
</body>
</html>
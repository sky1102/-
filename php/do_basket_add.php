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

$amount = $_POST['amount'];
$pro_ID = $_POST['id'];
// echo $amount."<br>";
// echo $pro_ID;
$cus_ID = $cookie_id;

$cus = "SELECT * FROM customer WHERE cus_ID='$cookie_id'";
$cus_result = $conn->query($cus);
if($cookie_id<50000)
{
    echo "<script>alert('請先登入!!!'); location.href = 'login.php';</script>";
}

$check = "SELECT amount FROM contain WHERE cus_ID=$cus_ID and product_ID=$pro_ID";
$check_result = $conn->query($check);
if (!$check_result) {
    echo "Error: ";
}
$row = mysqli_fetch_array($check_result);
if($row[0]!=null) 
{
	$am = $row['amount'];
	$add = "UPDATE contain SET amount=$am+$amount WHERE cus_ID=$cus_ID and product_ID=$pro_ID";
}
else
{
	$add = "INSERT INTO contain (cus_ID, product_ID, amount) VALUES($cus_ID, $pro_ID, $amount)";
}
if($conn->query($add) === TRUE)
{
	echo "<script language='javascript'>alert('新增成功!'); window.history.back(-1); </script>";
}
else 
{
	echo "<script language='javascript'>alert('新增失敗'); window.history.back(-1); </script>";
}

?>
</body>
</html>

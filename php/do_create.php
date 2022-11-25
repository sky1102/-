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
require('config2.php');

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


$name = $_POST['name'];
$passwd = $_POST['passwd'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$choose = $_POST['choose'];

if($choose=='1')
{
	$identity='customer';
	$iden='cus';
	$iden_id='cus_ID';
	$iden_name='cus_name';
	$iden_pass='cus_password';
	$iden_phone='cus_phone';
	$iden_addr='cus_address';
	$iden_email='cus_email';
} 
else if($choose=='2')
{
	$identity='company';
	$iden='com';
	$iden_id='com_ID';
	$iden_name='com_name';
	$iden_pass='com_password';
	$iden_phone='com_phone';
	$iden_addr='com_address';
	$iden_email='com_email';
} 


if (isset($name) && isset($passwd) && isset($phone) && isset($address) && isset($email) && $name && $passwd && $phone && $address && $email) {

// 流水編號
	if($choose=='1')
	{
		$id_sql = "SELECT max(cus_ID) FROM customer;";
		$id_res = $conn->query($id_sql);
		$result = mysqli_fetch_array($id_res);
		if($result[0]==null)
		{
			$id = $result+50000;
		}
		else
		{
			$id = $result[0]+1;
		}
	}
	else if($choose=='2')
	{
		$id_sql = "SELECT max(com_ID) FROM company;";
		$id_res = $conn->query($id_sql);
		$result = mysqli_fetch_array($id_res);
		if($result[0]==null)
		{
			$id = $result;
		}
		else
		{
			$id = $result[0]+1;
		}
	}
// 流水編號


	$insert_sql = "INSERT INTO $identity ($iden_id , $iden_name, $iden_pass, $iden_phone, $iden_addr, $iden_email)
					VALUES ('$id' , '$name', '$passwd', '$phone', '$address', '$email');";	
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "<script language='javascript'>alert('新增成功!'); location.href='login.php'; </script>";
	} else {
		echo "<script language='javascript'>alert('這個帳號已經申請過了!'); window.history.back(-1);</script>";
	}

}else{
	echo "<script language='javascript'>alert('資料不完全!'); window.history.back(-1);</script>";
}
				
?>
</body>
</html>


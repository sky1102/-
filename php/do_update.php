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

$cus_name = $_POST['name'];
$cus_password = $_POST['password'];
$cus_phone = $_POST['phone'];
$cus_address = $_POST['address'];
$cus_email = $_POST['email'];

if($cookie_id >= 50000)
{
	$go='info_cus.php';
	$identity='customer';
	$iden_id='cus_ID';
	$iden_name='cus_name';
	$iden_pass='cus_password';
	$iden_phone='cus_phone';
	$iden_addr='cus_address';
	$iden_email='cus_email';
} 
else
{
	$go='info_com.php';
	$identity='company';
	$iden_id='com_ID';
	$iden_name='com_name';
	$iden_pass='com_password';
	$iden_phone='com_phone';
	$iden_addr='com_address';
	$iden_email='com_email';
} 

if (isset($cus_name) && isset($cus_password) && isset($cus_phone) && isset($cus_address) && isset($cus_email) && $cus_name!=NULL && $cus_password!=NULL && $cus_phone!=NULL && $cus_address!=NULL && $cus_email!=NULL) {

	
	$update_sql = " UPDATE $identity 
					SET $iden_name='{$cus_name}',
						$iden_pass='{$cus_password}',
						$iden_phone='{$cus_phone}',
						$iden_addr='{$cus_address}',
						$iden_email='{$cus_email}' 
					WHERE $iden_id='{$cookie_id}' ";	// ******** update your personal settings ******** 
			
	if ($conn->query($update_sql) === TRUE) {
		echo "<script language='javascript'>alert('修改成功!'); location.href='".$go."'</script>";
	} 
	else {
		echo "<script language='javascript'>alert('修改失敗(已重複的Email)!'); window.history.back(-1); </script>";
	}

}
else{
	echo "<script language='javascript'>alert('資料不完全'); window.history.back(-1); </script>";
}
				
?>
</body>
</html>
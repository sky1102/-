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

$name = $_POST['product_name']; 
$variety = $_POST['variety'];
$farm_ID = $_POST['farm_ID'];
$year = $_POST['year'];
$season = $_POST['season'];
$sour = $_POST['sour'];
$balance = $_POST['balance'];
$baking = $_POST['baking'];
$weight = $_POST['weight'];
$price = $_POST['price'];
$look = $_POST['look'];
$com_ID = $cookie_id;

$fla = "SELECT * FROM flavor";    
$fla_result = $conn->query($fla); 
$check=0;  
while($fla_row = mysqli_fetch_array ( $fla_result ,MYSQLI_ASSOC))
{
	if($sour==$fla_row['sour'] && $balance==$fla_row['balance'])
	{
		$flavor_ID=$fla_row['flavor_ID'];
		$check=1;
		break;
	}
}
if($check==0)
{
	$flavor_ID=$sour*10+$balance;
	$insert_fla="INSERT INTO flavor (flavor_ID, sour, balance) VALUES ('$flavor_ID', '$sour', '$balance');";
	$conn->query($insert_fla);
}


if (isset($name) && isset($variety) && isset($farm_ID) && isset($year) && isset($season) && isset($sour) && isset($balance) && isset($baking) && isset($weight) && isset($price) && isset($look) && isset($com_ID) && $com_ID!=NULL && $look!=NULL && $sour!=NULL && $balance!=NULL && $baking!=NULL && $weight!=NULL && $price!=NULL && $name!=NULL && $variety!=NULL && $farm_ID!=NULL && $year!=NULL && $season!=NULL) {

	// 流水編號
	$id_sql = "SELECT max(product_ID) FROM product;";
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

	$insert_sql = "INSERT INTO product (product_ID , product_name, com_ID, variety, look, year, season, flavor_ID, baking, price, farm_ID, weight,del)
					VALUES ('$id' , '$name', '$com_ID', '$variety', '$look', '$year', '$season', '$flavor_ID', '$baking', '$price', '$farm_ID', '$weight','1');";	
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "<script language='javascript'>alert('新增成功!'); location.href='shop_com.php'; </script>";
	} else {
		echo "<script language='javascript'>alert('新增失敗!'); window.history.back(-1);</script>";
	}

}else{
	echo "<script language='javascript'>alert('資料不完全!'); window.history.back(-1);</script>";
}
				
?>
</body>
</html>

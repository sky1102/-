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

$cus_ID = $cookie_id;

$cus = "SELECT * FROM customer WHERE cus_ID='$cus_ID'";
$cus_result = $conn->query($cus);
if($cookie_id<50000)
{
    echo "<script>alert('請先登入!!!'); location.href = 'login.php';</script>";
}

// set up your sql
$sql = "SELECT * FROM contain WHERE cus_ID='$cus_ID'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error";
}

date_default_timezone_set("Asia/Taipei");
$order_ID = date('YmdHis');
$total = 0;
$record_add = "INSERT INTO record (order_ID, cus_ID, total, statement) VALUES ('$order_ID', '$cus_ID', '$total', '處理中')";
$res = $conn->query($record_add);
if(!$res)
{
	echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
}	
if($result->num_rows > 0)
{
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		// add trade
		$add_trade = "INSERT INTO trade (product_ID, order_ID, amount) VALUES ($row[product_ID], $order_ID, $row[amount])";
		if(!$conn->query($add_trade))
		{
			echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
		}
		// com_trade check
		$comID = "SELECT * FROM product NATURAL JOIN company WHERE product_ID=$row[product_ID]";
		$comID_res = $conn->query($comID);
		$comID_row = mysqli_fetch_array($comID_res, MYSQLI_ASSOC);
		$check_comtrade = "SELECT * FROM com_trade WHERE order_ID=$order_ID and com_ID=$comID_row[com_ID]";
		$comtrade_result = $conn->query($check_comtrade);
		if($comtrade_result->num_rows==0)
		{
			$add_comtrade = "INSERT INTO com_trade (order_ID, com_ID, statement) VALUES($order_ID, $comID_row[com_ID], '處理中')";
			if(!$conn->query($add_comtrade))
			{
				echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
			}
		}
		$total = $total+$comID_row[price]*$row[amount];
	}
	// update record
	$update_record = "UPDATE record SET total=$total WHERE cus_ID=$cus_ID and order_ID=$order_ID";
	if(!$conn->query($update_record))
	{
		echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
	}
}
else
{
	//delete record
	$del_record = "DELETE FROM record WHERE order_ID=$order_ID";
	if(!$conn->query($del_record))
	{
		echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
	}
	echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
}
$del_contain = "DELETE FROM contain WHERE cus_ID=$cus_ID";
if(!$conn->query($del_contain))
{
	echo "<script>alert('失敗'); location.href = 'basket.php';</script>";
}
echo "<script>alert('下單成功'); location.href = 'basket.php';</script>";

?>
</body>
</html>

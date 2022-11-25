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

$order_ID = $_POST['order_ID'];
$cookie_id = $_POST['cookie_id'];
$statement = $_POST['statement'];
// echo $order_ID."<br>". $cookie_id, $statement."<br>";
if (isset($order_ID) && isset($cookie_id) && isset($statement) && $cookie_id!=NULL && $order_ID!=NULL && $statement=='處理中') {

	
	$update_sql = " UPDATE com_trade
					SET com_trade.statement='運送中'
					WHERE statement='處理中' and order_ID = $order_ID and com_ID = $cookie_id";	
					// ******** update your personal settings ******** 
			
	if ($conn->query($update_sql) === TRUE) {
		echo "<script language='javascript'>alert('已出貨!'); location.href='rec_com.php'</script>";

		// 確認是否此單號的所有廠商已出貨
		$all_dili = " SELECT * FROM com_trade WHERE order_ID = $order_ID";
		$check_result = $conn->query($all_dili);

		if($check_result->num_rows>0) {
			$ch=0;
			while($row = mysqli_fetch_array ( $check_result ,MYSQLI_ASSOC)) {
				if($row[statement]==='運送中') {
					$ch=$ch+1;
				}
			}
			if($check_result->num_rows == $ch) {
				$change = "UPDATE record SET record.statement='運送中' WHERE order_ID=$order_ID";
				$conn->query($change);
			}
		}
	} 
	else {
		echo "<script language='javascript'>alert('出貨失敗!'); window.history.back(-1); </script>";
	}

}
else{
	echo "<script language='javascript'>alert('已出貨，請勿重複出貨'); window.history.back(-1); </script>";
}
				
?>
</body>
</html>

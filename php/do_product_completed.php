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
if (isset($order_ID) && isset($cookie_id) && isset($statement) && $cookie_id!=NULL && $order_ID!=NULL && $statement=='運送中') {


	$update_sql = " UPDATE record
					SET record.statement='已完成'
					WHERE statement='運送中' and order_ID = $order_ID and cus_ID = $cookie_id";	
					// ******** update your personal settings ******** 
			
	if ($conn->query($update_sql) === TRUE) {
		echo "<script language='javascript'>alert('確認完成訂單!'); location.href='rec_cus.php'</script>";

		// 修改此單號的所有廠商為已完成
		$all_comp = " SELECT * FROM com_trade WHERE order_ID = $order_ID";
		$all_result = $conn->query($all_comp);

		if($all_result->num_rows>0) {
			while($row = mysqli_fetch_array ( $all_result ,MYSQLI_ASSOC)) {
				$change = "UPDATE com_trade SET com_trade.statement='已完成' WHERE order_ID=$order_ID";
				$conn->query($change);
			}
		}
	} 
	else {
		echo "<script language='javascript'>alert('確認失敗!'); window.history.back(-1); </script>";
	}

}
elseif($statement=='處理中') {
	echo "<script language='javascript'>alert('尚未出貨'); window.history.back(-1); </script>";
}
else{
	echo "<script language='javascript'>alert('已完成訂單'); window.history.back(-1); </script>";
}
				
?>
</body>
</html>

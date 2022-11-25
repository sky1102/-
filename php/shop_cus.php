<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
    <title>咖啡豆產銷資訊系統</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


</head>

<!-- ----------------------------------------- -->
<body style=" font-family: 微軟正黑體;">
    <div class="row no-gutters">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <nav class="navbar " style="height:90px; background-color: #492D18">
            <!-- 上面 -->
            <a class="navbar-brand" style="color: white;">
              <h3><img src="https://image.flaticon.com/icons/svg/1588/1588922.svg" style="height:50px;width:50px"> <b> 咖啡豆產銷資訊系統</b></h3>
              <ul class="nav navbar-nav">
                <li>
                  <a data-toggle="tab">
                    <span style="color: white">
                    wellcome !
                    </span>
                  </a>
                  <a href="logout.php" class="btn btn-lg" style="height: 42px;font-size: 17px;margin: 0px 5px 10px 20px;background-color: #9F714F;color:white">
                    <span class="fa fa-sign-out"></span> Log out
                  </a>
                </li>
              </ul>
            </a>
          </nav>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <div class="list-group list-group-flush" style="width:110%; font-size: 18px;">
              <a href="shop_cus.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-shopping-bag" style="font-size:20px"></i>　購物商場</a>
              <a href="info_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-user-circle" style="font-size:20px"></i>　會員資料</a>
              <a href="rec_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
              <a href="basket.php" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart" style="font-size:20px"></i>　購物車</a>

            </div>
        </div>
    <div class="px-5 mt-4 col-xs-10 col-sm-10 col-md-10 col-lg-10">

      <!-- 中間--------------------------------------------------------- -->
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            	<th>ID</th><!-- product_ID -->
                <th>品名</th><!-- product_name -->
                <th>品種</th><!-- variety	 -->
                <th>產地</th><!--place -->
                <th>廠商</th>	<!-- com_ID	 -->
                <th>重量</th><!-- weight -->
                <th>價錢</th><!-- 	price -->
            </tr>
        </thead>
        					

        <tbody>
            <?php
				require('config.php');
				$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if (!$conn->set_charset("utf8")) {
					printf("Error loading character set utf8: %s\n", $conn->error);
					exit();
				}
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// ******** update your personal settings ******** 
				$sql = "SELECT * FROM product natural join place where del=1";	// set up your sql query
				$result = $conn->query($sql);	// Send SQL Query
        
        if($cookie_id<50000)
        {
          echo "<script>alert('請先登入!!!'); location.href = 'login.php';</script>";
        }

				if ($result->num_rows > 0) {	
					while ( $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC)) 
					{
            //廠商變數
            $com = "SELECT * FROM company natural join product WHERE product_ID=$row[product_ID] and del=1";
            $com_result = $conn->query($com);
						$com_row = mysqli_fetch_array($com_result);	
						// Process the Result here
						echo "<tr>";
						echo "<td>".$row["product_ID"]."</td>";
						echo "<th><a href='pro_detail_cus.php?id=$row[product_ID]'>".$row["product_name"] ."</th>";
						echo "<td>".$row["variety"]."</td>";
            echo "<td><a href='info_place.php?id=$row[farm_ID]'>".$row["country"]."</td>";
						echo "<td><a href='info_com_detail.php?id=$com_row[com_ID]'>".$com_row["com_name"]."</td>";
						echo "<td>".$row["weight"]."(g)</td>";
						echo "<td>$".$row["price"]."</td>";
						echo "</tr>";

					}
				} else {
					echo "<p align='center' style='color:#B19784;font-size:30px'><b>沒有商品</b></p>";
				}
			?>
        </tbody>
    </table>
  </div>
</body>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>

</html>

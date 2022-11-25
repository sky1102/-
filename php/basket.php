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


</head>
<style type="text/css">

  .total{
      display: inline-block;
      margin-left: 66%;
      margin-bottom: 0px;
      font-size:20px;
      width:22%;
      /*height:55px;*/
      padding:10px;
      background-color:#F3D8C1;
      border-radius: 5px;
      text-align: center;

  }
  .in_btn{
      display:inline-block;
      margin-left: 1%;
       margin-bottom: 0px;
      width:10%;
      /*height:50px;*/
      font-size:20px;
      background-color:#40BDD7;
      border:3px white solid;
  }
  .frame{
      background-color: #B19784;
      border-radius: 20px;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
    }
</style>

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
                    <span style="color: white">wellcome !</span>
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
              <a href="shop_cus.php" class="list-group-item list-group-item-action" ><i class="fa fa-shopping-bag" style="font-size:20px"></i>　購物商場</a>
              <a href="info_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-user-circle" style="font-size:20px"></i>　會員資料</a>
              <a href="rec_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
              <a href="basket.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-shopping-cart" style="font-size:20px"></i>　購物車</a>

            </div>
        </div>
    <div class="px-5 mt-4 col-xs-10 col-sm-10 col-md-10 col-lg-10">

      <!-- 中間--------------------------------------------------------- -->

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
        if($cookie_id<50000)
        {
          echo "<script>alert('請先登入!!!'); location.href = 'login.php';</script>";
        }

        $sql = "SELECT * FROM contain NATURAL JOIN product NATURAL JOIN company WHERE cus_ID='$cookie_id' and del=1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {                
              echo "
          <div class='frame'>
            <table id='example' class='table table-striped table-bordered' style='width:100%;background-color:white'>
              <thead>
                <tr>
                    <th>ID</th>
                    <th>品名</th>
                    <th>品種</th>
                    <th>廠商</th>
                    <th>重量</th>
                    <th>價錢</th>
                    <th>數量</th>
                    <th>小計</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>";

          $total=0;
          while ( $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC)) 
          {
            // Process the Result here
            echo "<tr>";
            echo "<td>".$row["product_ID"]."</td>";
            echo "<th><a href='pro_detail_cus.php?id=$row[product_ID]'>".$row["product_name"] ."</th>";
            echo "<td>".$row["variety"]."</td>";
            echo "<td>".$row["com_name"]."</td>";
            echo "<td>".$row["weight"]."(g)</td>";
            echo "<td>$".$row["price"]."</td>";
            echo "<td>".$row["amount"]."</td>";
            echo "<td>$".$row["amount"]*$row["price"]."</td>";
            echo "<td><a href='do_delete_basket.php?id=$row[product_ID]'>刪除</td>";
            echo "</tr>";
            $total= $total+$row["amount"]*$row["price"];
          }
          echo "</tbody> </table>";
          echo "

            <p class='total'>總金額：$".$total."</p>
            <input type='button' class='in_btn btn btn-info' value='下單' onclick=location.href='do_order_create.php'>
            
          </div>";
          
        } 
        else {
          echo "<p align='center' style='color:#B19784;font-size:30px'><b>沒有商品</b></p>";
        }

      ?>
   

  </div>

</body>
</html>

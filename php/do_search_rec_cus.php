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
    *{
        font-family:微軟正黑體;
    }
    .oid, .state, .total{
      display: inline-block;
      margin-left: auto;
      margin-right: auto;
      font-size:18px;
      height:55px;
      padding:15px 0px 15px 20px;
      background-color:#F3D8C1;
      width:26%;
    }
    .in{
      width:10%;
      display: inline-block;
    }
    .in_btn{
      width:100%;
      height:50px;
      font-size:20px;
      background-color:#40BDD7;
      border:3px white solid;
    }
    .space{
      display: inline-block;
      width:2%;
    }
    .frame{
      background-color: #B19784;
      border-radius: 20px;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
    }
    .search1, .search2{
      display: inline-block;
      margin-left: 10px;
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
              <a href="shop_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-shopping-bag" style="font-size:20px"></i>　購物商場</a>
              <a href="info_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-user-circle" style="font-size:20px"></i>　會員資料</a>
              <a href="rec_cus.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
              <a href="basket.php" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart" style="font-size:20px"></i>　購物車</a>

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
        $sql = "SELECT * FROM record WHERE cus_ID='{$cookie_id}'";  // set up your sql query
        $result = $conn->query($sql); // Send SQL Query               
        
        $statement=$_POST['statement'];
        $year=$_POST['year'];
        $month=$_POST['month'];
        $day1=$_POST['day1'];
        $day2=$_POST['day2'];

        // if($year==NULL)
        // {echo "yes";}
        // if($mouth==NULL)
        // {echo $month,"/";}
        // echo $day1,"/";
        // echo $day2;

if (isset($year) && isset($month) && isset($day1) && isset($day2) ) {

        $cnt=0;
        if ($result->num_rows > 0) {  
          while ( $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC)) 
          {
            

            // $order_ID = $_GET['id'];
            $order_ID = $row["order_ID"];
            $sql_in = "SELECT * FROM trade WHERE order_ID='{$order_ID}'";  // set up your sql query
            $result_in = $conn->query($sql_in); // Send SQL Query

            $rec = "SELECT * FROM record WHERE order_ID='{$order_ID}'";
            $rec_result = $conn->query($rec);
            $record = mysqli_fetch_array($rec_result); 

            //廠商變數
            $com = "SELECT * FROM company natural join com_trade natural join trade natural join product WHERE order_ID='{$order_ID}'";
            $com_result = $conn->query($com);

            //商品變數
            $pro = "SELECT * FROM product natural join trade WHERE order_ID='{$order_ID}'";
            $pro_result = $conn->query($pro);

            $check=0;
            
            if($statement=="NULL") $check+=1;
            else if($statement==$record["statement"]) $check+=1;

            if($year=="") $check+=4;
            else
            {
              for($i=0;$i<4;$i+=1)
              {
              	if($year[$i]==$record["order_ID"][$i]) $check+=1;
              }
            }

          	if($month=="NULL") $check+=2;
            else if($month==$record["order_ID"][4].$record["order_ID"][5]) $check+=2;

            if($day1=="NULL") $check+=2;
            else if($day1<=$record["order_ID"][6].$record["order_ID"][7]) $check+=2;

          	if($day2=="NULL") $check+=2;
            else if($day2>=$record["order_ID"][6].$record["order_ID"][7]) $check+=2;

          if($check<11) 
          {
            $cnt+=1;
            continue;
          }
             echo "
             <div class='frame'>
                <div class='oid'>
                  <b>單號：</b>".$record["order_ID"]."
                </div>
                <div class='space'>   </div>
                <div class='state'>
                  <b>狀態：</b>".$record["statement"]."
                </div>
                <div class='space'>   </div>
                <div class='total'>
                  <b>總金額：$</b>".$record["total"]."
                </div>
                <div class='space'>  </div>
                <div class='in'>
                <form  action='do_product_completed.php' method='POST'>
                  <input type='hidden' name='order_ID' value=".$record["order_ID"].">
                  <input type='hidden' name='statement' value=".$record["statement"].">
                  <input type='hidden' name='cookie_id' value=".$cookie_id.">
                  <button type='submit' name='submit' class='in_btn btn btn-info' align='center'>到貨</button>
                </form>
                </div>
                <br><br>
              

              <table class='table table-striped table-bordered' style='width:100%;background-color:white'>
              <thead>
                  <tr>
                    <th>廠商</th>
                    <th>商品名稱</th>
                    <th>單價</th>
                    <th>數量</th>
                    <th>小計</th>
                  </tr>
              </thead>
                        
              <tbody>";


              if ($result_in->num_rows > 0) 
              {  
                while (mysqli_fetch_array ( $result_in ,MYSQLI_ASSOC)) 
                {
                  $com_row = mysqli_fetch_array($com_result); 
                  $pro_row = mysqli_fetch_array($pro_result); 
                  $subtotal = $pro_row["price"]*$pro_row["amount"];
                  // Process the Result here
                  echo "<tr>";
                  echo "<td><a href='info_com_detail.php?id=$com_row[com_ID]'>".$com_row["com_name"]."</td>";
                  echo "<td><a href='pro_detail_cus.php?id=$pro_row[product_ID]'>".$pro_row["product_name"]."</td>";
                  echo "<td>$".$pro_row["price"]."</td>";
                  echo "<td>".$pro_row["amount"]."</td>";
                  echo "<td>$".$subtotal."</td>";
                  echo "</tr>";
                }
                
              } 
              else 
              {
                echo "<p align='center' style='color:red'>0 results</p>";
              }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "<br>";

          }
          if($result->num_rows==$cnt)
          {
            echo "<p align='center' style='color:#B19784;font-size:30px'><b>查無訂單資料</b></p>";
          }

        } 

        else 
        {
          echo "<p align='center' style='color:#B19784;font-size:30px'><b>尚無訂單</b></p>";
        }

}else{
  echo "<script language='javascript'>alert('資料不完全!'); window.history.back(-1);</script>";

}
      ?>
  </div>
</body>

</html>

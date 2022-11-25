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
        /*border:solid 1px black;*/
        font-family:微軟正黑體;
    }
    .state{
      display: inline-block;
      margin-left: auto;
      margin-right: auto;
      width:100%;
      font-size:18px;
      height:55px;
      padding:15px 0px 15px 30px;
      background-color:#F3D8C1;
    }
    .frame{
      /*display: inline-block;*/
      background-color: #B19784;
      border-radius: 20px;
      padding: 20px;
      width:80%;
      margin-left: auto;
      margin-right: auto;
    }
    .table{
      width:80%;
      margin-left: auto;
      margin-right: auto;
      background-color:#eee;
    }

/*    .state.s2{
      padding:0px;
      padding-left: 40%;
    }
    .bt{
      background-color:#40BDD7;
      border:3px white solid;
    }*/
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
              <a href="shop_cus.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-shopping-bag" style="font-size:20px"></i>　購物商場</a>
              <a href="info_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-user-circle" style="font-size:20px"></i>　會員資料</a>
              <a href="rec_cus.php" class="list-group-item list-group-item-action"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
              <a href="basket.php" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart" style="font-size:20px"></i>　購物車</a>

            </div>
        </div>
    <div class="px-5 mt-4 col-xs-10 col-sm-10 col-md-10 col-lg-10">
      <!-- 中間 -->
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
        $com_ID = $_GET['id'];
        $sql = "SELECT * FROM company WHERE com_ID='{$com_ID}'";  // set up your sql query
        $result = $conn->query($sql); // Send SQL Query               
        
        $pro = "SELECT * FROM product WHERE com_ID='{$com_ID}'";
        $pro_result = $conn->query($pro); 

        if ($result->num_rows > 0) {  
            $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC);
             echo "
             <div class='frame'>
                <div class='state'>
                  <b>公司名稱：</b>".$row["com_name"]."
                  <b>　　　　電子信箱：</b>".$row["com_email"]."</div><br>

                <div class='state'>  
                  <b>電話：</b>".$row["com_phone"]."
                  <b>　　　　聯絡地址：</b>".$row["com_address"]."</div><br>               
              </div><br>
              ";

            
            echo "
              <table id='example' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th>ID</th>
                      <th>品名</th>
                      <th>品種</th> 
                      <th>重量</th>
                      <th>價錢</th>
                  </tr>
                </thead><tbody>";
          if ($pro_result->num_rows > 0) {  
            while($pro_row = mysqli_fetch_array ( $pro_result ,MYSQLI_ASSOC) ){
              if($pro_row["del"]==0) continue;
                echo "<tr>";
                echo "<td>".$pro_row["product_ID"]."</td>";
                echo "<th><a href='pro_detail_cus.php?id=$pro_row[product_ID]'>".$pro_row["product_name"] ."</th>";
                echo "<td>".$pro_row["variety"]."</td>";
                echo "<td>".$pro_row["weight"]."(g)</td>";
                echo "<td>$".$pro_row["price"]."</td>";
                echo "</tr>";
            }
          }
          else{
            echo "<p align='center' style='color:#B19784;font-size:30px'><b>沒有商品</b></p>";
          }
          echo "</tbody></table>";
        } 

        else 
        {
          echo "<p align='center' style='color:#B19784;font-size:30px'><b>沒有資料</b></p>";
        }


      ?>
  </div>
</body>

</html>

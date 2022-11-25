<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>咖啡豆產銷資訊系統</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    *{
        /*border:solid 1px black;*/
        font-family:微軟正黑體;
    }
    .left{
        display: inline-block;
        width:45%;
        margin-top:auto;
        margin-bottom:auto;
    }
    .right{
        display: inline-block;
        width:50%;
        height:100%;
        padding:15px 0px 15px 30px;
        background-color:#F3D8C1;
        /*font-family:SetoFont;*/
        font-weight: 15px;
        font-size:20px;
        /*margin-right: 10%;*/
    }
    .price{
      text-align:center;
      width:300px; 
      margin-left:auto;
      margin-right:auto;
      margin-top:8%;
      margin-bottom:8%;
      color:#E5CAB3;
      background-color:#A36631;/*#F8C4C0;#7B4513*/
      border:solid 5px #E5CAB3;
      padding: 20px;
      font-size:40px;
      /*font-family:SetoFont;*/
    }
    .product{
      text-align:center;
      width:100%; 
      margin-left:auto;
      margin-right:auto;
      /*font-family:SetoFont;*/
      color:#7B4513;
      font-size:30px;
    } 
    .intro{
        width:85%;
        padding:15px 30px ;
        background-color:#bbb;
        /*font-family:SetoFont;*/
        font-weight: 15px;
        font-size:20px;
        margin-left:auto;
        margin-right:auto;
    }
    .del{
        font-size:50px;
        color:red;
        text-align: center;
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
              <a href="shop_com.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-shopping-bag" style="font-size:20px"></i>　管理賣場</a>
              <a href="create_pro.php" class="list-group-item list-group-item-action"><i class="material-icons" style="font-size:20px">playlist_add</i>　新增商品</a>
              <a href="info_com.php" class="list-group-item list-group-item-action"><i class="fa fa-user-circle" style="font-size:20px"></i>　廠商資料</a>
              <a href="rec_com.php" class="list-group-item list-group-item-action"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
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

        $pro_ID = $_GET['id'];
        $sql = "SELECT * FROM product WHERE product_ID='{$pro_ID}'";    
        $result = $conn->query($sql);   
        $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC);

        //廠商變數
        $com = "SELECT * FROM company natural join product WHERE product_ID='{$pro_ID}'";
        $com_result = $conn->query($com);
        $com_row = mysqli_fetch_array($com_result);
        //產地變數
        $farm = "SELECT * FROM place natural join product WHERE product_ID='{$pro_ID}'";
        $farm_result = $conn->query($farm);
        $farm_row = mysqli_fetch_array($farm_result);
        //風味變數
        $flavor = "SELECT * FROM flavor natural join product WHERE product_ID='{$pro_ID}'";
        $flavor_result = $conn->query($flavor);
        $flavor_row = mysqli_fetch_array($flavor_result);

        //將空白還原
        $row["look"]=str_replace(" ","&nbsp;",$row["look"]);
        //將換行還原
        $row["look"]=nl2br($row["look"]);

        // Process the Result here
        if($row['del']==0)
        {
            echo "<div> ";
                echo "<div class='del'><b>已下架</b></div>";
            echo "</div>";
        }
        echo "<div> ";
            echo "<div class='product'><b>".$row["product_name"]."</b></div>";
        echo "</div>";
        echo "<br> ";
        echo "<div> ";
            echo "<div class='left'>"; 
                echo "<div class='price'>NT$ ".$row["price"]."</div>";
                echo "<br>";
                // echo "<div class='basket'><a href='###.php?id=$row[product_ID]'> <i class='fa fa-cart-plus' ></i>  加入購物車 </a></div>";
                // echo "<br>";
            echo "</div>";
            echo "<div class='right'> "; 
                echo "<div><b>產品編號：</b>".$row["product_ID"]."</div>";
                echo "<div><b>廠商：</b>".$com_row["com_name"]."</div>";
                echo "<div><b>品種：</b>".$row["variety"]."</div>";
                echo "<div><b>重量：</b>".$row["weight"]."(g)</div>";
                echo "<div><b>產地：</b><a href='info_place.php?id=$farm_row[farm_ID]'>".$farm_row["country"]."</a></div>";
                echo "<div><b>年份/季節：</b>".$row["year"]." / ".$row["season"]."</div>";
                // echo "<div><b>年份：</b>".$row["year"]."</div>";
                // echo "<div><b>季節：</b>".$row["season"]."</div>";
                echo "<div><b>酸度/平衡度/烘焙度：</b>".$flavor_row["sour"]." / ".$flavor_row["balance"]." / ".$row["baking"]."</div>";
                // echo "<div><b>介紹：</b>".$row["look"]."</div>";
            echo "</div>";
        echo "</div>";
        echo "<br>";
        echo "<div class='intro'> ";
            echo "<div><b>介紹：</b><br>".$row["look"]."</b></div>";
        echo "</div>";
        echo "<br><br>";

    ?>
  </div>
</body>


</html>

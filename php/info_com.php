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
    <script type="text/javascript">
    var show;
    window.onload=function()
    {
      show=document.getElementById("show");
    };
    function shownew()
    {
      show.style.display="inline-block";
    }
    </script>
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
      display: inline-block;
      background-color: #B19784;
      border-radius: 20px;
      padding: 20px;
      width:47%;
      margin-left: 2%
    }
    #show{
      display: none;
    }
    .state.s2{
      padding:0px;
      padding-left: 40%;
    }
    .bt{
      background-color:#40BDD7;
      border:3px white solid;
      font-size:18px;
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
              <a href="shop_com.php" class="list-group-item list-group-item-action" ><i class="fa fa-shopping-bag" style="font-size:20px"></i>　管理賣場</a>
              <a href="create_pro.php" class="list-group-item list-group-item-action"><i class="material-icons" style="font-size:20px">playlist_add</i>　新增商品</a>
              <a href="info_com.php" class="list-group-item list-group-item-action" style="background-color: #D5B8A3"><i class="fa fa-user-circle" style="font-size:20px"></i>　廠商資料</a>
              <a href="rec_com.php" class="list-group-item list-group-item-action"><i class="fa fa-newspaper-o" style="font-size:20px"></i>　訂單紀錄</a>
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
        $sql = "SELECT * FROM company WHERE com_ID='{$cookie_id}'";  // set up your sql query
        $result = $conn->query($sql); // Send SQL Query               
    
        if ($result->num_rows > 0) {  
          while ( $row = mysqli_fetch_array ( $result ,MYSQLI_ASSOC)) 
          {
             echo "
             <div class='frame'>
                <div class='state'>
                  <b>　　姓名：</b>".$row["com_name"]."</div><br>
                <div class='state'>
                  <b>　　電話：</b>".$row["com_phone"]."</div><br>
                <div class='state'>
                  <b>電子信箱：</b>".$row["com_email"]."</div><br>
                <div class='state'>
                  <b>　　密碼：</b>********</div><br>
                <div class='state'>
                  <b>聯絡地址：</b>".$row["com_address"]."</div><br>
                <div class='state s2'>
                  <button type='button' class='bt btn btn-info' onclick='shownew();'>修改資料</button>
                </div>
              </div>

                <div id=show class='frame'>
                  <form method='post' action='do_update.php'>
                  <div class='state'>
                    <b>　　姓名：</b><input name='name' style='width:250px' value=".$row["com_name"].">
                  </div><br>
                  <div class='state'>
                    <b>　　電話：</b><input name='phone' style='width:250px' value=".$row["com_phone"].">
                  </div><br>
                  <div class='state'>
                    <b>電子信箱：</b><input name='email' style='width:250px' value=".$row["com_email"].">
                  </div><br>
                  <div class='state'>
                    <b>　　密碼：</b><input name='password' style='width:250px' value=".$row["com_password"].">
                  </div><br>
                  <div class='state'>
                    <b>聯絡地址：</b><input name='address' style='width:250px' value=".$row["com_address"].">
                  </div><br>
                  <div class='state s2'>
                    <input type='submit' class='bt btn btn-info' value='確認修改' />
                  </div></form>
                </div>
              ";
          }
        } 

        else 
        {
          echo "<p align='center' style='color:#B19784;font-size:30px'><b>沒有資料</b></p>";
        }
      ?>
  </div>
</body>

</html>

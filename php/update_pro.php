<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>咖啡豆產銷資訊系統</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    </script>

</head>
<style>
  .form{
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
        
        // ******** update your personal settings ******** 
        $sql = "SELECT * FROM product natural join place WHERE product_ID=$_GET[id]"; // set up your sql query
        $result = $conn->query($sql); // Send SQL Query
        $pro = mysqli_fetch_array ( $result ,MYSQLI_ASSOC);

        $fla = "SELECT * FROM product natural join flavor WHERE product_ID=$_GET[id]";
        $fla_result = $conn->query($fla); // Send SQL Query
        $flavor = mysqli_fetch_array ($fla_result ,MYSQLI_ASSOC);
      echo "
      <div class='d-flex justify-content-center' >
        <form action='do_update_pro.php' method='POST' name='form1' style='width:70%' >

        <input type='hidden' name='id'  value='$_GET[id]'/>

          <div class='input-group mb-3' >
            <div class='input-group-prepend'>
              <span class='input-group-text'>商品名稱</span></div>
            <input type='text' name='product_name' class='form-control' value='$pro[product_name]'></div>

            <div class='input-group mb-3'>
            <div class='input-group-prepend'>
              <span class='input-group-text'>品種名稱</span></div>
            <input type='text' name='variety' class='form-control' value='$pro[variety]'></div>

            <div class='input-group mb-3' >
            <div class='input-group-prepend'>
              <span class='input-group-text'>產地</span></div>
              <select style='width: 25%'  name='farm_ID' value='$pro[farm_ID]'>
               <option value='".$pro['farm_ID']."'>".$pro['country']."</option> 
               <option value='90292'>越南</option>
               <option value='90821'>印度</option>
               <option value='91328'>印尼</option>
               <option value='92281'>衣索比亞</option>
               <option value='92282'>肯亞</option>
               <option value='92976'>剛果</option>
               <option value='94291'>多明尼加</option>
               <option value='94372'>哥斯大黎加</option>
               <option value='94387'>瓜地馬拉</option>
               <option value='94388'>巴西</option>
               <option value='94437'>哥倫比亞</option>
               <option value='94847'>尼加拉瓜</option>
               <option value='95287'>牙買加</option>
               <option value='95737'>巴拿馬</option>
               <option value='95847'>厄瓜多爾</option>
               <option value='95867'>祕魯</option>
               <option value='95873'>波多黎各</option>
               <option value='96920'>新幾內亞</option>
               <option value='97827'>夏威夷</option>
              </select>

            <div class='input-group-prepend'>
              <span class='input-group-text'>年份</span></div>
            <input type='text' name='year' class='form-control' value='$pro[year]'>

            <div class='input-group-prepend' >
              <span class='input-group-text'>季節</span></div>
              <select style='width: 25%' name='season' value='$pro[season]'>
               <option value='".$pro['season']."'>".$pro['season']."</option> 
               <option  value='春天'>春天</option>
               <option  value='夏天'>夏天</option>
               <option  value='秋天'>秋天</option>
               <option  value='冬天'>冬天</option>
              </select>
            </div>

            <div class='input-group mb-3' >
            <div class='input-group-prepend'>
              <span class='input-group-text'>酸度</span></div>
            <input type='text' name='sour' class='form-control' value='$flavor[sour]'>
            <div class='input-group-prepend'>
              <span class='input-group-text'>平衡度</span></div>
            <input type='text' name='balance' class='form-control' value='$flavor[balance]'>
            <div class='input-group-prepend'>
            <span class='input-group-text'>烘焙度</span></div>
            <input type='text' name='baking' class='form-control' value='$pro[baking]'></div>

            <div class='input-group mb-3' >
            <div class='input-group-prepend'>
              <span class='input-group-text'>重量</span></div>
            <input type='text' name='weight' class='form-control' value='$pro[weight]'>
            <div class='input-group-prepend'>
              <span class='input-group-text'>價錢</span></div>
            <input type='text' name='price' class='form-control' value='$pro[price]'></div>

            <div class='input-group mb-3'>
            <div class='input-group-prepend'>
              <span class='input-group-text'>產品描述</span></div>
             
            <textarea type='text' name='look' class='form-control' style='height:200px;overflow:auto' >$pro[look]</textarea></div>
          <div class='form-group'> 
            <div class='col-sm-offset-2 col-sm-10'>
              <div class='d-flex justify-content-center'>
                <button type='submit' name='button' id='button' class='btn btn-info'style='margin-top:10px;margin-left: 100px'>修改</button>
              </div>
            </div>
        </form>
  </div>

";?>

</body>

</html>

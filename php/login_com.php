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
<!-- ----------------------------------------- -->

<body style=" font-family: 微軟正黑體;">
    <div class="row no-gutters">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <nav class="navbar " style="height:90px; background-color: #492D18">
          <a class="navbar-brand" style="color: white;">
          <h3><img src="https://image.flaticon.com/icons/svg/1588/1588922.svg" style="height:50px;width:50px"><b> 咖啡豆產銷資訊系統</b></h3>
          </a>
        </nav>
        

        </div>
         <div class="mt-5 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <div class="d-flex justify-content-center" >

            <form class="form-horizontal" action="do_login_com.php" method="POST" name="form1"　>        
              
              <div  align="center" style="font-size:25px;color:#aaa;color:#9F714F">《廠商登入》</div>

              <br>
              <div class="form-group">
                <label class="control-label col-sm-5" for="email">帳號:</label>
                <div class="col-sm-12">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-5" for="password">密碼:</label>
                <div class="col-sm-12"> 
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
              </div>

              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="d-flex justify-content-center">
                    <button type="submit" name="button" id="button" class="btn btn-default"style="margin-top:20px;">登入</button>
                    <input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'shop_com.php?id=$_GET[id]'; ?>"> 
                  </div>
                </div>
              </div>

            </form>

          </div>
        </div>
  </div>
</body>
</html>
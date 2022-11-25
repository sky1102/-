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
          <h3><img src="https://image.flaticon.com/icons/svg/1588/1588922.svg" style="height:50px;width:50px"><b> 咖啡豆資訊產銷系統</b></h3>
          </a>
        </nav>
        
        </div>
         <div class="mt-3 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <div class="d-flex justify-content-center" >
            <form action="do_create.php" method="POST" name="form1"　>

              <!-- --------選擇身分---------- -->
              <div class="form-check-inline" style="margin-left: 200px">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="choose" value="1" checked='1'>消費者
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="choose" value="2">廠商
                </label>
              </div>
              <!-- --------選擇身分---------- -->
              
              <div>姓名:<input type="name" name="name" class="form-control" id="name" placeholder="至多20個字元" style="width:500px"></div>
              <br>
              <div>Email:<input type="email" name="email" class="form-control" id="email" placeholder="至多50個字元"></div>
              <br>
              <div>密碼:<input type="password" name="passwd" class="form-control" id="passwd" placeholder="至多20個字元"></div>
              <br>
              <div>電話號碼:<input type="phone" name="phone" class="form-control" id="phone" placeholder="格式:0912345678"></div>
              <br>
              <div>連絡地址:<input type="address" name="address" class="form-control" id="address" placeholder="至多50個字元"></div>
              
              

              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="d-flex justify-content-center">
                    <button type="submit" name="button" id="button" class="btn btn-default"style="margin-top:20px;margin-left: 100px">註冊</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
  </div>

</body>

</html>

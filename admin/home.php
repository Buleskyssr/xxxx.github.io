<?php
include('../includes/common.php');
if ($islogin != 1) {
  exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
?>

<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>后台首页</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="../static/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid p-t-15">

    <div class="row">
      <div class="col-md-6 col-xl-3">
        <div class="card bg-primary text-white">
          <div class="card-body clearfix">
            <div class="flex-box">
              <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-link fs-22"></i></span>
              <span class="fs-22 lh-22" id="count1"></span>
            </div>
            <div class="text-right">今日链接</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card bg-danger text-white">
          <div class="card-body clearfix">
            <div class="flex-box">
              <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-link fs-22"></i></span>
              <span class="fs-22 lh-22" id="count2"></span>
            </div>
            <div class="text-right">昨日链接</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card bg-success text-white">
          <div class="card-body clearfix">
            <div class="flex-box">
              <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-link fs-22"></i></span>
              <span class="fs-22 lh-22" id="count3"></span>
            </div>
            <div class="text-right">总链接数</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card bg-purple text-white">
          <div class="card-body clearfix">
            <div class="flex-box">
              <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-eye fs-22"></i></span>
              <span class="fs-22 lh-22" id="count4"></span>
            </div>
            <div class="text-right">总访问数</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">使用说明</h5>
            <p>链接显示404是未设置伪静态，nginx伪静态规则在根目录的nginx.conf里面</p>
            <p>安装完成进入后台请先前往系统设置里面填写自己的短网址域名</p>
            <p>QQ和微信网址检测需要填写对接token才有效果</p>
            <p>短网址后缀数量建议在2-10范围内，不要超过20</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="card">

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../static/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/popper.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/main.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/Chart.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#title').html('正在加载数据中...');
      $.ajax({
        type: "GET",
        url: "ajax.php?act=getcount",
        dataType: 'json',
        async: true,
        success: function(data) {
          $('#title').html('后台首页');
          $('#count1').html(data.count1);
          $('#count2').html(data.count2);
          $('#count3').html(data.count3);
          $('#count4').html(data.count4);
        }
      });
    })
  </script>
</body>

</html>
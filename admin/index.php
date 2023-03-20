<?php
include('../includes/common.php');
if ($islogin != 1) {
  exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>短网址后台管理中心</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <link rel="stylesheet" type="text/css" href="../static/admin/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="../static/admin/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../static/admin/js/bootstrap-multitabs/multitabs.min.css">
  <link rel="stylesheet" type="text/css" href="../static/admin/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="../static/admin/css/style.min.css">
</head>

<body>
  <div class="lyear-layout-web">
    <div class="lyear-layout-container">
      <!--左侧导航-->
      <aside class="lyear-layout-sidebar">

        <!-- logo -->
        <div id="logo" class="sidebar-header">
          <a href="index.html"><img src="../static/admin/images/logo-sidebar.png" title="缥缈QQ1807139605" alt="缥缈QQ1807139605" /></a>
        </div>
        <div class="lyear-layout-sidebar-info lyear-scroll">

          <nav class="sidebar-main">
            <ul class="nav-drawer">
              <li class="nav-item active"> <a class="multitabs" href="home.php"><i class="mdi mdi-home"></i>
                  <span>后台首页</span></a> </li>
              <li class="nav-item"> <a class="multitabs" href="urllist.php"><i class="mdi mdi-link"></i>
                  <span>网址管理</span></a> </li>
              <li class="nav-item nav-item-has-subnav">
                <a href="javascript:void(0)"><i class="mdi mdi-settings"></i> <span>系统设置</span></a>
                <ul class="nav nav-subnav">
                  <li> <a class="multitabs" href="set.php?mod=site">网站信息设置</a> </li>
                </ul>
              </li>
            </ul>
          </nav>

          <div class="sidebar-footer">
            <p class="copyright">Copyright &copy; 2019-2020. <a target="_blank" href="">搏天短网址</a> All
              rights reserved.</p>
          </div>
        </div>

      </aside>
      <!--End 左侧导航-->

      <!--头部信息-->
      <header class="lyear-layout-header">

        <nav class="navbar">

          <div class="navbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
          </div>

          <ul class="navbar-right d-flex align-items-center">
            <!--切换主题配色-->
            <li class="dropdown dropdown-skin">
              <span data-toggle="dropdown" class="icon-item"><i class="mdi mdi-palette"></i></span>
              <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                <li class="drop-title">
                  <p>LOGO</p>
                </li>
                <li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                    <label for="logo_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                    <label for="logo_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                    <label for="logo_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                    <label for="logo_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                    <label for="logo_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                    <label for="logo_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                    <label for="logo_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                    <label for="logo_bg_8"></label>
                  </span>
                </li>
                <li class="drop-title">
                  <p>头部</p>
                </li>
                <li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                    <label for="header_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                    <label for="header_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                    <label for="header_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                    <label for="header_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                    <label for="header_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                    <label for="header_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                    <label for="header_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                    <label for="header_bg_8"></label>
                  </span>
                </li>
                <li class="drop-title">
                  <p>侧边栏</p>
                </li>
                <li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                    <label for="sidebar_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                    <label for="sidebar_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                    <label for="sidebar_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                    <label for="sidebar_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                    <label for="sidebar_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                    <label for="sidebar_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                    <label for="sidebar_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                    <label for="sidebar_bg_8"></label>
                  </span>
                </li>
              </ul>
            </li>
            <!--切换主题配色-->
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle">
                <img class="img-avatar img-avatar-48 m-r-10" src="https://q.qlogo.cn/headimg_dl?dst_uin=10001&spec=100" alt="<?php echo $conf['admin_user'] ?>" />
                <span><?php echo $conf['admin_user'] ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li>
                  <a class="multitabs dropdown-item" data-url="pwd.php" href="javascript:void(0)"><i class="mdi mdi-lock-outline"></i> 修改密码</a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="cleanCache()"><i class="mdi mdi-delete"></i> 清空缓存</a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="./login.php?logout"><i class="mdi mdi-logout-variant"></i> 退出登录</a>
                </li>
              </ul>
            </li>
          </ul>

        </nav>

      </header>
      <!--End 头部信息-->

      <!--页面主要内容-->
      <main class="lyear-layout-content">

        <div id="iframe-content"></div>

      </main>
      <!--End 页面主要内容-->
    </div>
  </div>

  <script type="text/javascript" src="../static/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/popper.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/bootstrap-multitabs/multitabs.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/jquery.cookie.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/index.min.js"></script>
  <script>
    function cleanCache() {
      $.ajax({
        url: "ajax.php?act=cleanCache",
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data.code == 0) {
            alert('清理成功');
          }
        },
        error: function(data) {
          alert('服务器错误');
          return false;
        }
      });
    }
  </script>
</body>

</html>
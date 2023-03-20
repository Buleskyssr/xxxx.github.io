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
  <title>网站信息配置</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="../static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
  <link href="../static/admin/css/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.css">
  <link href="../static/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid p-t-15">

    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <ul class="nav nav-tabs page-tabs pt-2 pl-3 pr-3">
            <li class="nav-item"> <a href="set.php?mod=site" class="nav-link <?php echo checkIfActive('site') ?>">基本</a> </li>
            <li class="nav-item"> <a href="set.php?mod=link" class="nav-link <?php echo checkIfActive('link') ?>">链接</a> </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active">
              <?php
              $mod = isset($_GET['mod']) ? $_GET['mod'] : '';
              if ($mod == 'site') {
              ?>
                <form name="site" action="ajax.php?act=setSite" class="edit-form">
                  <div class="form-group">
                    <label for="web_name">网站名称</label>
                    <input class="form-control" type="text" id="web_name" name="web_name" value="<?php echo $conf['web_name'] ?>" placeholder="请输入网站名称" required>
                  </div>
                  <div class="form-group">
                    <label for="domain">网站域名</label>
                    <input class="form-control" type="text" id="domain" name="domain" value="<?php echo $conf['domain'] ?>" placeholder="请输入网站域名" required>
                  </div>
                  <div class="form-group">
                    <label for="develop_mode">域名协议</label>
                    <div class="controls-box clearfix">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="is_https" id="is_https1" class="custom-control-input" value="0" <?php echo  $conf['is_https'] == 0 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="is_https1">http</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="is_https" id="is_https2" class="custom-control-input" value="1" <?php echo  $conf['is_https'] == 1 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="is_https2">https</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="title">网站标题</label>
                    <input class="form-control" type="text" id="title" name="title" value="<?php echo $conf['title'] ?>" placeholder="请输入网站标题">
                  </div>
                  <div class="form-group">
                    <label for="keywords">站点关键词</label>
                    <input class="form-control" type="text" id="keywords" name="keywords" value="<?php echo $conf['keywords'] ?>" placeholder="请输入站点关键词">
                  </div>
                  <div class="form-group">
                    <label for="description">站点描述</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="请输入站点描述"><?php echo $conf['description'] ?></textarea>
                    <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
                  </div>
                  <div class="form-group">
                    <label for="icp">备案信息</label>
                    <input class="form-control" type="text" id="icp" name="icp" value="<?php echo $conf['icp'] ?>" placeholder="请输入备案信息">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary m-r-5 ajax-post" target-form="site">修 改</button>
                  </div>
                </form>
              <?php
              } elseif ($mod == 'link') {
              ?>
                <form name="link" action="ajax.php?act=setLink" class="edit-form">
                  <div class="form-group">
                    <label for="dwz_token">对接token</label>
                    <input class="form-control" type="text" id="dwz_token" name="dwz_token" value="<?php echo $conf['dwz_token'] ?>" placeholder="请输入对接token">
                    <small class="help-block">对接短网址，网址检测等等需要用到的token，token获取地址：<a href="https://apis.btstu.cn/user" target="_blank">https://apis.btstu.cn/user</a></small>
                  </div>
                  <div class="form-group">
                    <label for="link_length">后缀长度</label>
                    <input class="form-control" type="number" id="link_length" name="link_length" value="<?php echo $conf['link_length'] ?>" placeholder="请输入后缀长度">
                  </div>
                  <div class="form-group">
                    <label>生成前操作</label>
                    <div class="controls-box clearfix">
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="qqcheck" id="qqcheck" <?php echo  $conf['qqcheck'] == 1 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="qqcheck">QQ检测</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="wxcheck" id="wxcheck" <?php echo  $conf['wxcheck'] == 1 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="wxcheck">微信检测</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="noqq" id="noqq" <?php echo  $conf['noqq'] == 1 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="noqq">禁止QQ拦截域名生成</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="nowx" id="nowx" <?php echo  $conf['nowx'] == 1 ? 'checked=""' : '' ?>>
                        <label class="custom-control-label" for="nowx">禁止微信拦截域名生成</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary m-r-5 ajax-post" target-form="link">修 改</button>
                  </div>
                </form>
              <?php
              }
              ?>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

  <script type="text/javascript" src="../static/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/popper.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/lyear-loading.js"></script>
  <script type="text/javascript" src="../static/admin/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/jquery-confirm/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.js"></script>
  <script type="text/javascript" src="../static/admin/js/main.min.js"></script>
  <script>
    $(function() {
      jQuery(document).delegate('.ajax-post', 'click', function() {
        var self = jQuery(this),
          tips = self.data('tips'),
          ajax_url = self.attr("href") || self.data("url");
        var target_form = self.attr('target-form');
        var text = self.data('tips');
        var form = jQuery('form[name="' + target_form + '"]');

        if (form.length == 0) {
          form = jQuery('.' + target_form);
        }

        var form_data = form.serialize();
        if ('submit' == self.attr('type') || ajax_url) {
          if (void 0 == form.get(0)) return false;

          if ('FORM' == form.get(0).nodeName) {
            ajax_url = ajax_url || form.get(0).action;

            if (self.hasClass('confirm')) {
              $.confirm({
                title: '',
                content: tips || '确认要执行该操作吗？',
                type: 'orange',
                typeAnimated: true,
                buttons: {
                  confirm: {
                    text: '确认',
                    btnClass: 'btn-blue',
                    action: function() {
                      var loader = $('body').lyearloading({
                        opacity: 0.2,
                        spinnerSize: 'lg'
                      });
                      self.attr('autocomplete', 'off').prop('disabled', true);
                      ajaxPostFun(self, ajax_url, form_data, loader);
                    }
                  },
                  cancel: {
                    text: '取消',
                    action: function() {}
                  }
                }
              });
              return false;
            } else {
              self.attr("autocomplete", "off").prop("disabled", true);
            }
          } else if ('INPUT' == form.get(0).nodeName || 'SELECT' == form.get(0).nodeName || 'TEXTAREA' == form.get(0).nodeName) {
            if (form.get(0).type == 'checkbox' && form_data == '') {
              showNotify('请选择您要操作的数据', 'danger');
              return false;
            }

            if (self.hasClass('confirm')) {
              $.confirm({
                title: '',
                content: tips || '确认要执行该操作吗？',
                type: 'orange',
                typeAnimated: true,
                buttons: {
                  confirm: {
                    text: '确认',
                    btnClass: 'btn-blue',
                    action: function() {
                      var loader = $('body').lyearloading({
                        opacity: 0.2,
                        spinnerSize: 'lg'
                      });
                      self.attr('autocomplete', 'off').prop('disabled', true);

                      ajaxPostFun(self, ajax_url, form_data, loader);
                    }
                  },
                  cancel: {
                    text: '取消',
                    action: function() {}
                  }
                }
              });
              return false;
            } else {
              self.attr("autocomplete", "off").prop("disabled", true);
            }
          } else {
            if (self.hasClass('confirm')) {
              $.confirm({
                title: '',
                content: tips || '确认要执行该操作吗？',
                type: 'orange',
                typeAnimated: true,
                buttons: {
                  confirm: {
                    text: '确认',
                    btnClass: 'btn-blue',
                    action: function() {
                      var loader = $('body').lyearloading({
                        opacity: 0.2,
                        spinnerSize: 'lg'
                      });
                      self.attr('autocomplete', 'off').prop('disabled', true);

                      ajaxPostFun(self, ajax_url, form_data, loader);
                    }
                  },
                  cancel: {
                    text: '取消',
                    action: function() {}
                  }
                }
              });
              return false;
            } else {
              form_data = form.find("input,select,textarea").serialize();
              self.attr("autocomplete", "off").prop("disabled", true);
            }
          }

          var loader = $('body').lyearloading({
            opacity: 0.2,
            spinnerSize: 'lg'
          });
          ajaxPostFun(self, ajax_url, form_data, loader);

          return false;
        }
      });


      function ajaxPostFun(selfObj, ajax_url, form_data, loader) {
        jQuery.post(ajax_url, form_data).done(function(res) {
          loader.destroy();
          var msg = res.msg;
          if (res.code == 0) {
            if (res.url && !selfObj.hasClass('no-refresh')) {
              msg += '页面即将自动跳转';
            }
            showNotify(msg, 'success');
            setTimeout(function() {
              selfObj.attr("autocomplete", "on").prop("disabled", false);
              return selfObj.hasClass("no-refresh") ? false : (res.url ? location.href = res.url : window.location.reload());
            }, 1500);
          } else {
            showNotify(msg, 'danger');
            selfObj.attr("autocomplete", "on").prop("disabled", false);
          }
        }).fail(function() {
          loader.destroy();
          showNotify('服务器发生错误，请稍后再试', 'danger');
          selfObj.attr("autocomplete", "on").prop("disabled", false);
        });
      }

      function showNotify($msg, $type, $delay, $icon, $from, $align) {
        $type = $type || 'info';
        $delay = $delay || 1000;
        $from = $from || 'top';
        $align = $align || 'right';
        $enter = $type == 'danger' ? 'animated shake' : 'animated fadeInUp';

        jQuery.notify({
          icon: $icon,
          message: $msg
        }, {
          element: 'body',
          type: $type,
          allow_dismiss: true,
          newest_on_top: true,
          showProgressbar: false,
          placement: {
            from: $from,
            align: $align
          },
          offset: 20,
          spacing: 10,
          z_index: 10800,
          delay: $delay,
          animate: {
            enter: $enter,
            exit: 'animated fadeOutDown'
          }
        });
      }

    });
  </script>
</body>

</html>
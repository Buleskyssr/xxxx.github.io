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
    <title>修改密码</title>
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
                    <div class="card-body">
                        <form name="editAdmin" action="ajax.php?act=editAdmin" class="site-form">
                            <div class="form-group">
                                <label for="old-password">用户名</label>
                                <input type="text" class="form-control" name="admin_user" id="admin_user" placeholder="请输入用户名" value="<?php echo $conf['admin_user'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="old-password">旧密码</label>
                                <input type="password" class="form-control" name="pwd_old" id="pwd_old" placeholder="输入原登录密码">
                            </div>
                            <div class="form-group">
                                <label for="new-password">新密码</label>
                                <input type="password" class="form-control" name="pwd_new" id="pwd_new" placeholder="输入新的密码">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">确认新密码</label>
                                <input type="password" class="form-control" name="pwd_new2" id="pwd_new2" placeholder="请再次输入密码">
                            </div>
                            <button type="submit" class="btn btn-primary ajax-post" target-form="editAdmin">确认修改</button>
                        </form>

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
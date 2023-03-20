<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>网址管理</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../static/admin/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="../static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.css">
    <link href="../static/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-t-15">
        <div class="row">
            <div class="col-lg-12">

                <div class="modal fade" id="addUrl" tabindex="-1" role="dialog" aria-labelledby="addUrlChangeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="addUrlChangeTitle">添加网址</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add" action="ajax.php?act=addUrl">
                                    <div class="form-group">
                                        <label for="add-url" class="col-form-label">跳转地址:</label>
                                        <input type="text" class="form-control" id="add-url" name="url">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary ajax-post" target-form="add">添加</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editChangeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="editChangeTitle">修改网址</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="edit" action="ajax.php?act=editUrl">
                                    <div class="form-group">
                                        <label for="edit-id" class="col-form-label">网址ID:</label>
                                        <input type="text" class="form-control" id="edit-id" name="id" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-url" class="col-form-label">跳转地址:</label>
                                        <input type="text" class="form-control" id="edit-url" name="url">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary ajax-post refresh" target-form="edit">修改</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div id="toolbar" class="toolbar-btn-action">
                            <button id="btn_add" type="button" class="btn btn-primary m-r-5" data-toggle="modal" data-target="#addUrl">
                                <span class="mdi mdi-plus" aria-hidden="true"></span>新增
                            </button>
                            <button id="btn_edit" type="button" class="btn btn-success m-r-5" onclick="setActiveAll(1)">
                                <span class="mdi mdi-check" aria-hidden="true"></span>解封
                            </button>
                            <button id="btn_edit" type="button" class="btn btn-warning m-r-5" onclick="setActiveAll(0)">
                                <span class="mdi mdi-block-helper" aria-hidden="true"></span>封禁
                            </button>
                            <button id="btn_delete" type="button" class="btn btn-danger" onclick="delAll()">
                                <span class="mdi mdi-window-close" aria-hidden="true"></span>删除
                            </button>
                        </div>
                        <table id="listTable"></table>
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
    <script type="text/javascript" src="../static/admin/js/bootstrap-table/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script src="https://lib.baomitu.com/clipboard.js/2.0.6/clipboard.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/main.min.js"></script>
    <script type="text/javascript">
        $('#listTable').bootstrapTable({
            classes: 'table table-bordered table-hover table-striped',
            url: 'ajax.php?act=urllist',
            method: 'get',
            dataType: 'jsonp', // 因为本示例中是跨域的调用,所以涉及到ajax都采用jsonp,
            uniqueId: 'id',
            selectItemName: 'ids[]',
            idField: 'id', // 每行的唯一标识字段
            toolbar: '#toolbar', // 工具按钮容器
            //clickToSelect: true,     // 是否启用点击选中行
            showColumns: true, // 是否显示所有的列
            showRefresh: true, // 是否显示刷新按钮

            showToggle: true, // 是否显示详细视图和列表视图的切换按钮(clickToSelect同时设置为true时点击会报错)

            pagination: true, // 是否显示分页
            sortOrder: "asc", // 排序方式
            queryParams: function(params) {
                var temp = {
                    limit: params.limit, // 每页数据量
                    offset: params.offset, // sql语句起始索引
                    page: (params.offset / params.limit) + 1,
                    sort: params.sort, // 排序的列名
                    sortOrder: params.order // 排序方式'asc' 'desc'
                };
                return temp;
            }, // 传递参数
            sidePagination: "client", // 分页方式：client客户端分页，server服务端分页
            pageNumber: 1, // 初始化加载第一页，默认第一页
            pageSize: 10, // 每页的记录行数
            pageList: [10, 25, 50, 100], // 可供选择的每页的行数
            search: true, // 是否显示表格搜索，此搜索是客户端搜索

            //showExport: true,        // 是否显示导出按钮, 导出功能需要导出插件支持(tableexport.min.js)
            //exportDataType: "basic", // 导出数据类型, 'basic':当前页, 'all':所有数据, 'selected':选中的数据

            columns: [{
                    field: 'ids',
                    checkbox: true
                }, {
                    field: 'id',
                    title: 'ID',
                    sortable: true
                }, {
                    field: 'dwz',
                    title: '短链地址',
                    formatter: function(value, row, index) {
                        var value = '<a title="点击复制" onclick="msg()" class="clipboard" data-clipboard-text="' + row['dwz'] + '">' + row['dwz'] + ' </a>';
                        return value;
                    }
                },
                {
                    field: 'url',
                    title: '跳转网址',
                    formatter: function(value, row, index) {
                        var value = '<a title="点击复制" onclick="msg()" class="clipboard" data-clipboard-text="' + row['url'] + '">' + row['url'] + ' </a>';
                        return value;
                    }
                },
                {
                    field: 'qqsafe',
                    title: 'QQ状态',
                    formatter: function(value, row, index) {
                        var value = "";
                        if (row.qqsafe == '0') {
                            value = '<span class="badge badge-danger">拦截</span>';
                        } else if (row.qqsafe == '1') {
                            value = '<span class="badge badge-success">正常</span>';
                        } else {
                            value = row.pType;
                        }
                        return value;
                    },
                    sortable: true
                },
                {
                    field: 'wxsafe',
                    title: '微信状态',
                    formatter: function(value, row, index) {
                        var value = "";
                        if (row.wxsafe == '0') {
                            value = '<span class="badge badge-danger">拦截</span>';
                        } else if (row.wxsafe == '1') {
                            value = '<span class="badge badge-success">正常</span>';
                        } else {
                            value = row.pType;
                        }
                        return value;
                    },
                    sortable: true
                },
                {
                    field: 'view',
                    title: '访问次数',
                    sortable: true
                },
                {
                    field: 'ip',
                    title: '添加ip'
                },
                {
                    field: 'addtime',
                    title: '添加时间',
                    sortable: true
                },
                {
                    field: 'status',
                    title: '状态',
                    formatter: function(value, row, index) {
                        var value = "";
                        if (row.status == '0') {
                            value = '<span class="badge badge-danger" onclick="setactive(' + row['id'] + ',' + row['status'] + ')">封禁</span>';
                        } else if (row.status == '1') {
                            value = '<span class="badge badge-success" onclick="setactive(' + row['id'] + ',' + row['status'] + ')">正常</span>';
                        } else {
                            value = row.pType;
                        }
                        return value;
                    },
                    sortable: true
                },
                {
                    field: 'operate',
                    title: '操作',
                    formatter: function(value, row, index) {
                        var value = "";
                        value = '<div class="btn-group"><button type="button" class="btn btn-xs btn-default" title="编辑" data-toggle="modal" data-target="#edit" data-id="' + row['id'] + '" data-url="' + row['url'] + '"><i class="mdi mdi-pencil"></i></button>';
                        value += '<button type="button" onclick="del(' + row['id'] + ')" class="btn btn-xs btn-default" title="删除"><i class="mdi mdi-window-close"></i></button></div>';
                        return value;
                    }
                }
            ],
            onLoadSuccess: function(data) {
                $("[data-toggle='tooltip']").tooltip();
            }
        });

        function setactive(id, status) {
            var loader = $('body').lyearloading({
                opacity: 0.2,
                spinnerSize: 'lg'
            });
            status == 1 ? status = 0 : status = 1;
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setUrlStatus&id=' + id + '&status=' + status,
                dataType: 'json',
                success: function(data) {
                    loader.destroy();
                    if (data.code == 0) {
                        showNotify(data.msg, 'success');
                        setTimeout(function() {
                            return $("#listTable").bootstrapTable('refresh');
                        }, 1000);
                    } else {
                        showNotify(data.msg, 'danger');
                    }
                },
                error: function(data) {
                    loader.destroy();
                    showNotify('服务器发生错误，请稍后再试', 'danger');
                    return false;
                }
            });


        }

        function setActiveAll(status) {
            var selRows = $("#listTable").bootstrapTable("getSelections");
            if (selRows.length == 0) {
                alert("请至少选择一条数据");
                return;
            }
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
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
                            var postData = "";
                            $.each(selRows, function(i) {
                                postData += this.id;
                                if (i < selRows.length - 1) {
                                    postData += "&";
                                }
                            });
                            $.ajax({
                                url: "ajax.php?act=setUrlStatusAll",
                                type: "POST",
                                data: {
                                    "status": status,
                                    "str": postData
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });

                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        function delAll() {
            var selRows = $("#listTable").bootstrapTable("getSelections");
            if (selRows.length == 0) {
                alert("请至少选择一条数据");
                return;
            }
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
                type: 'red',
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
                            var postData = "";
                            $.each(selRows, function(i) {
                                postData += this.id;
                                if (i < selRows.length - 1) {
                                    postData += "&";
                                }
                            });
                            $.ajax({
                                url: "ajax.php?act=delUrlAll",
                                type: "POST",
                                data: {
                                    "str": postData
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });

                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var url = button.data('url')
            var modal = $(this)
            modal.find('#edit-id').val(id)
            modal.find('#edit-url').val(url)
        })

        function del(id) {
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
                type: 'red',
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
                            $.ajax({
                                url: "ajax.php?act=delUrl",
                                type: "POST",
                                data: {
                                    "id": id
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });

                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        function msg() {
            showNotify('复制成功', 'success');
        }


        $(function() {
            new ClipboardJS('.clipboard');
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
                        showNotify(msg, 'success');
                        setTimeout(function() {
                            selfObj.attr("autocomplete", "on").prop("disabled", false);
                            return selfObj.hasClass("refresh") ? location.reload() : $("#listTable").bootstrapTable('refresh');
                        }, 1000);
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
        });

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
    </script>
</body>

</html>
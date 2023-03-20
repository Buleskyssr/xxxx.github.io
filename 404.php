<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>404</title>
    <link href="<?php echo $siteurl ?>static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $siteurl ?>static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo $siteurl ?>static/admin/css/style.min.css" rel="stylesheet">
    <style>
        .error-page {
            height: 100%;
            position: fixed;
            width: 100%;
        }

        .error-body {
            padding-top: 5%;
        }

        .error-body h1 {
            font-size: 210px;
            font-weight: 700;
            text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #868e96;
            line-height: 210px;
            color: #868e96;
        }
    </style>
</head>

<body>
    <section class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>404</h1>
                <h5 class="mb-5 mt-3 text-gray">很抱歉，但是那个页面看起来已经不存在了。</h5>
                <a href="javascript:history.go(-1)" class="btn btn-primary">返回上一页</a>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="<?php echo $siteurl ?>static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteurl ?>static/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        ;
    </script>
</body>

</html>
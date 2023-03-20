<?php
include('../includes/common.php');
if ($islogin != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'getcount':
        $t = date("Y-m-d");
        $y = date("Y-m-d", strtotime("-1 day"));
        $count1 = $DB->getColumn("select count(*) from pre_url where addtime>'$t'");
        $count2 = $DB->getColumn("select count(*) from pre_url where addtime>'$y' and addtime<'$t'");
        $count3 = $DB->getColumn("select count(*) from pre_url");
        $count4 = $DB->getColumn("select sum(view) from pre_url");
        $result = array("code" => 0, "count1" => $count1, "count2" => $count2, "count3" => $count3, "count4" => $count4, "chart" => $chart);
        exit(json_encode($result));
        break;
    case 'urllist':
        $callback = $_GET['callback'];
        $totle = $DB->getColumn("select count(*) from pre_url");
        $rs = $DB->query("select * from pre_url order by id desc");
        $i = 0;
        $rows = array();
        while ($res = $rs->fetch()) {
            $rows[$i] = array('id' => $res['id'], 'code' => $res['code'], 'dwz' => $res['dwz'], 'url' => $res['url'], 'ip' => $res['ip'], 'qqsafe' => $res['qqsafe'], 'wxsafe' => $res['wxsafe'], 'status' => $res['status'], 'addtime' => $res['addtime'], 'view' => $res['view']);
            $i++;
        }
        $result = array('rows' => $rows, 'total' => $totle);
        exit($callback . '(' . json_encode($result) . ')');
        break;
    case 'addUrl':
        $url = $_POST['url'];
        if ($DB->getColumn("select id from pre_url where url='$url' limit 1")) {
            $result = array("code" => -1, "msg" => "该网址已存在");
            exit(json_encode($result));
        }
        $ret = cturl($url);
        if ($ret['code'] == 0) {
            $result = array("code" => 0, "msg" => "添加成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => $ret['msg']);
            exit(json_encode($result));
        }
        break;
    case 'setUrlStatusAll':
        $id = explode('&', $_POST['str']);
        $i = 0;
        $status = $_POST['status'];
        while ($i < count($id)) {
            $DB->query("update pre_url set status = '$status' where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0, "msg" => "修改成功");
        exit(json_encode($result));
        break;
    case 'delUrlAll':
        $id = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($id)) {
            $DB->exec("delete from pre_url where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0, "msg" => "删除成功");
        exit(json_encode($result));
        break;
    case 'setUrlStatus':
        $id = $_GET['id'];
        $status = intval($_GET['status']);
        $rs = $DB->query("update pre_url set status='$status' where id='{$id}'");
        if ($rs) {
            $result = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "修改失败");
            exit(json_encode($result));
        }
        break;
    case 'editUrl':
        $id = $_POST['id'];
        $url = $_POST['url'];
        if ($DB->getColumn("select id from pre_url where id='$id'")) {
            if ($DB->query("update pre_url set url='$url' where id='$id'")) {
                $result = array("code" => 0, "msg" => "修改成功");
                exit(json_encode($result));
            } else {
                $result = array("code" => -1, "msg" => "修改失败");
                exit(json_encode($result));
            }
        } else {
            $result = array("code" => -1, "msg" => "该网址不存在");
            exit(json_encode($result));
        }
        break;
    case 'delUrl':
        $id = $_POST['id'];
        if ($DB->exec("delete from pre_url where id = '$id'")) {
            $result = array("code" => 0, "msg" => "删除成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "删除失败");
            exit(json_encode($result));
        }
        break;
    case 'setSite':
        $web_name = $_POST['web_name'];
        if ($web_name == '') {
            $msg = '网址名称不能为空！';
            $result = array('code' => -1, 'msg' => $msg);
            exit(json_encode($result));
        }
        $domain = $_POST['domain'];
        $is_https = $_POST['is_https'];
        $title = $_POST['title'];
        $keywords = $_POST['keywords'];
        $description = $_POST['description'];
        $icp = $_POST['icp'];
        saveSetting('web_name', $web_name);
        saveSetting('domain', $domain);
        saveSetting('is_https', $is_https);
        saveSetting('title', $title);
        saveSetting('keywords', $keywords);
        saveSetting('description', $description);
        saveSetting('icp', $icp);
        $ad = $CACHE->clear();
        if ($ad) {
            $result = array('code' => 0, 'msg' => '修改成功');
        } else {
            $msg = '修改失败';
            $result = array('code' => -1, 'msg' => $msg);
        }
        exit(json_encode($result));
        break;
    case 'setLink':
        $dwz_token = $_POST['dwz_token'];
        $link_length = $_POST['link_length'];
        $qqcheck = isset($_POST['qqcheck']) ? 1 : 0;
        $wxcheck = isset($_POST['wxcheck']) ? 1 : 0;
        $noqq = isset($_POST['noqq']) ? 1 : 0;
        $nowx = isset($_POST['nowx']) ? 1 : 0;
        saveSetting('dwz_token', $dwz_token);
        saveSetting('link_length', $link_length);
        saveSetting('qqcheck', $qqcheck);
        saveSetting('wxcheck', $wxcheck);
        saveSetting('noqq', $noqq);
        saveSetting('nowx', $nowx);
        $ad = $CACHE->clear();
        if ($ad) {
            $result = array('code' => 0, 'msg' => '修改成功');
        } else {
            $msg = '修改失败';
            $result = array('code' => -1, 'msg' => $msg);
        }
        exit(json_encode($result));
        break;
    case 'editAdmin':
        $admin_user = trim($_REQUEST['admin_user']);
        $pwd_old = trim($_REQUEST['pwd_old']);
        $pwd_new = trim($_REQUEST['pwd_new']);
        $pwd_new2 = trim($_REQUEST['pwd_new2']);
        if ($admin_user == '') {
            $msg = '用户名不能为空！';
            $result = array("code" => -1, "msg" => $msg);
            exit(json_encode($result));
        }
        saveSetting('admin_user', $admin_user);
        if (!empty($pwd_new) && !empty($pwd_new2)) {
            if ($pwd_old != $conf['admin_pwd']) {
                $msg = '旧密码不正确！';
                $result = array("code" => -1, "msg" => $msg);
                exit(json_encode($result));
            }
            if ($pwd_new != $pwd_new2) {
                $msg = '俩次输入的密码不一致！';
                $result = array("code" => -1, "msg" => $msg);
                exit(json_encode($result));
            }
            saveSetting('admin_pwd', $pwd_new);
        }
        $ad = $CACHE->clear();
        if ($ad) {
            $result = array("code" => 0, "msg" => "修改成功");
        } else {
            $msg = '修改失败';
            $result = array("code" => -1, "msg" => $msg);
        }
        exit(json_encode($result));
        break;
    case 'cleanCache':
        $CACHE->clear();
        $result = array('code' => 0);
        exit(json_encode($result));
        break;
}

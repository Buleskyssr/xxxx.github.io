<?php
include("./includes/common.php");
@header('Access-Control-Allow-Origin:*');
@header('Content-Type: application/json; charset=UTF-8');
$url = isset($_REQUEST['url']) ? $_REQUEST['url'] : '';
if ($url == '') {
    $result = array('code' => -1, 'msg' => 'url不能为空');
} else {
    if ($dwz = $DB->getColumn("select dwz from pre_url where url='$url'")) {
        $result = array('code' => 0, 'msg' => '生成成功', 'dwz' => $dwz);
    } else {
        $ret = cturl($url);
        if ($ret['code'] == 0) {
            $result = array('code' => 0, 'msg' => '生成成功', 'dwz' => $ret['dwz']);
        } else {
            $result = array('code' => -1, 'msg' => $ret['msg']);
        }
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

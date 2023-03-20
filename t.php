<?php
include('includes/common.php');
$code = $_GET['code'];
$res = $DB->getRow("select * from pre_url where code='$code'");
if (!$res || $res['status'] == 0) {
    include('404.php');
    exit();
} else {
    header("Location: " . $res['url'], true, 302);
    $DB->query("update pre_url set view=view+1 where code='$code'");
}

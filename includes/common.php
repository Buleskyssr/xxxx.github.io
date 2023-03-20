<?php
error_reporting(0);
if (defined('IN_CRONLITE')) return;
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
date_default_timezone_set('Asia/Shanghai');
$date = date("Y-m-d H:i:s");

if (!$nosession) session_start();

if (is_file(SYSTEM_ROOT . '360safe/360webscan.php')) {
    require_once SYSTEM_ROOT . '360safe/360webscan.php';
}

@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Pragma: no-cache');
if ($is_defend == true || CC_Defender == 3) {
    include_once SYSTEM_ROOT . 'txprotect.php';
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    }
    if (CC_Defender == 1 && getspider() == false || CC_Defender == 2 || CC_Defender == 3) {
        cc_defender();
    }
}

$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';

include_once(SYSTEM_ROOT . "autoloader.php");
Autoloader::register();
require ROOT . 'config.php';

if (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) //检测安装1
{
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！<a href="./install/">点此安装</a>';
    exit();
}

$DB = new \lib\PdoHelper($dbconfig);

if ($DB->query("select * from pre_config where 1") == FALSE) //检测安装2
{
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！<a href="./install/">点此安装</a>';
    exit();
}

$CACHE = new \lib\Cache();
$conf = $CACHE->pre_fetch();
$password_hash = '!@#%!s!0' . serialize($dbconfig);
define('SYS_KEY', $conf['syskey']);
include_once SYSTEM_ROOT . 'function.php';
include_once SYSTEM_ROOT . 'member.php';

$clientip = x_real_ip();
if (isset($_COOKIE["admin_token"])) {
    $session = md5($conf['admin_user'] . $conf['admin_pwd'] . $password_hash);
    if ($session === $_COOKIE["admin_token"]) {
        $islogin = 1;
    }
}
function x_real_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $xip) {
            if (!preg_match('#^(10|172\\.16|192\\.168)\\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    } else {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            } else {
                if (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
                    $ip = $_SERVER['HTTP_X_REAL_IP'];
                }
            }
        }
    }
    return $ip;
}
function getspider($useragent = '')
{
    global $conf;
    $value = 0;
    if (strpos($_SERVER['SCRIPT_NAME'], 'long.php') !== false) $value++;
    if (strpos($_SERVER['SCRIPT_NAME'], 'cron.php') !== false) $value++;
    if (strpos($_SERVER['SCRIPT_NAME'], 'dwz.php') !== false) $value++;
    if (strpos($_SERVER['SCRIPT_NAME'], 'api.php') !== false) $value++;
    if (strpos($_SERVER['SCRIPT_NAME'], 'qr.php') !== false) $value++;
    if (strpos($_SERVER['SCRIPT_NAME'], 't.php') !== false) $value++;
    if ($value > 0)   return true;
    if (!$useragent) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    }
    $useragent = strtolower($useragent);
    if (strpos($useragent, 'baiduspider') !== false) {
        return 'baiduspider';
    }
    if (strpos($useragent, 'googlebot') !== false) {
        return 'googlebot';
    }
    if (strpos($useragent, '360spider') !== false) {
        return '360spider';
    }
    if (strpos($useragent, 'haosouspider') !== false) {
        return 'haosouspider';
    }
    if (strpos($useragent, 'soso') !== false) {
        return 'soso';
    }
    if (strpos($useragent, 'bing') !== false) {
        return 'bing';
    }
    if (strpos($useragent, 'yahoo') !== false) {
        return 'yahoo';
    }
    if (strpos($useragent, 'sohu-search') !== false) {
        return 'Sohubot';
    }
    if (strpos($useragent, 'sogou') !== false) {
        return 'sogou';
    }
    if (strpos($useragent, 'youdaobot') !== false) {
        return 'YoudaoBot';
    }
    if (strpos($useragent, 'yodaobot') !== false) {
        return 'YodaoBot';
    }
    if (strpos($useragent, 'robozilla') !== false) {
        return 'Robozilla';
    }
    if (strpos($useragent, 'msnbot') !== false) {
        return 'msnbot';
    }
    if (strpos($useragent, 'lycos') !== false) {
        return 'Lycos';
    }
    if (strpos($useragent, 'ia_archiver') !== false || strpos($useragent, 'iaarchiver') !== false) {
        return 'alexa';
    }
    if (strpos($useragent, 'archive.org_bot') !== false) {
        return 'Archive';
    }
    if (strpos($useragent, 'robozilla') !== false) {
        return 'Robozilla';
    }
    if (strpos($useragent, 'sitebot') !== false) {
        return 'SiteBot';
    }
    if (strpos($useragent, 'mj12bot') !== false) {
        return 'MJ12bot';
    }
    if (strpos($useragent, 'gosospider') !== false) {
        return 'gosospider';
    }
    if (strpos($useragent, 'gigabot') !== false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'yrspider') !== false) {
        return 'YRSpider';
    }
    if (strpos($useragent, 'gigabot') !== false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'jikespider') !== false) {
        return 'jikespider';
    }
    if (strpos($useragent, 'addsugarspiderbot') !== false) {
        return 'AddSugarSpiderBot';/*非常少*/
    }
    if (strpos($useragent, 'testspider') !== false) {
        return 'TestSpider';
    }
    if (strpos($useragent, 'etaospider') !== false) {
        return 'EtaoSpider';
    }
    if (strpos($useragent, 'wangidspider') !== false) {
        return 'WangIDSpider';
    }
    if (strpos($useragent, 'foxspider') !== false) {
        return 'FoxSpider';
    }
    if (strpos($useragent, 'docomo') !== false) {
        return 'DoCoMo';
    }
    if (strpos($useragent, 'yandexbot') !== false) {
        return 'YandexBot';
    }
    if (strpos($useragent, 'ezooms') !== false) {
        return 'Ezooms';/*个人*/
    }
    if (strpos($useragent, 'sinaweibobot') !== false) {
        return 'SinaWeiboBot';
    }
    if (strpos($useragent, 'catchbot') !== false) {
        return 'CatchBot';
    }
    if (strpos($useragent, 'surveybot') !== false) {
        return 'SurveyBot';
    }
    if (strpos($useragent, 'dotbot') !== false) {
        return 'DotBot';
    }
    if (strpos($useragent, 'purebot') !== false) {
        return 'Purebot';
    }
    if (strpos($useragent, 'ccbot') !== false) {
        return 'CCBot';
    }
    if (strpos($useragent, 'mlbot') !== false) {
        return 'MLBot';
    }
    if (strpos($useragent, 'adsbot-google') !== false) {
        return 'AdsBot-Google';
    }
    if (strpos($useragent, 'ahrefsbot') !== false) {
        return 'AhrefsBot';
    }
    if (strpos($useragent, 'spbot') !== false) {
        return 'spbot';
    }
    if (strpos($useragent, 'augustbot') !== false) {
        return 'AugustBot';
    }
    return false;
}
if ($_GET['rand'] && $_SESSION['cron_session'] != $_GET['rand']) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit('浏览器不支持COOKIE或者不正常访问！');
}
function cc_defender()
{
    if (!$_SESSION['cron_session']) {
        if (!getspider()) {
            $cron_session = md5(uniqid() . rand(1, 1000));
            $_SESSION['cron_session'] = $cron_session;
            @header('Content-Type: text/html; charset=UTF-8');
            echo '<!DOCTYPE html><html><head>';
            echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
            echo '<meta http-equiv="Content-Language" content="zh-CN" />';
            echo '<meta name="renderer" content="webkit">';
            echo '<script language="javascript">window.location.href="?' . $_SERVER['QUERY_STRING'] . '&rand=' . $cron_session . '";</script>';
            exit('</body></html>');
        }
    }
}

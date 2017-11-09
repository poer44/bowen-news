<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26 0026
 * Time: 下午 4:31
 */
session_start();
unset($_SESSION['admin_id']);
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo "<script charset='utf-8' type='text/javascript'>window.alert('退出成功，即将返回后台登陆界面');</Script>";
echo "<script>url=\"admin_login.html\";window.location.href=url;</script>";
exit;
?>
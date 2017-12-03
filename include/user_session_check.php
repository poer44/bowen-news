<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26 0026
 * Time: 下午 5:07
 */
if(!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
    echo "<script charset='utf-8' type='text/javascript'>window.alert('请登录后操作');</Script>";
    echo "<script>url=\"../login.html\";window.location.href=url;</script>";
    exit;
}
else{
    $user_check=$_SESSION['user_id'];
}
?>
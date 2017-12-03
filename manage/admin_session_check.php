<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26 0026
 * Time: 下午 5:07
 */
if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['admin_id'])) {
    echo "<script>url=\"admin_login.html\";window.location.href=url;</script>";
    exit;
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26 0026
 * Time: 下午 4:31
 */
if (!isset($_SESSION)) {
    session_start();
}
session_unset();
session_destroy();
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo "<Script>window.history.go(-1);window.location.reload();</Script>";
exit;
?>
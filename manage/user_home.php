<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 上午 11:06
 */
if ($_GET) {
    $id = $_GET['id'];
    $url = './user_view.php?id=' . $id;
    echo "<script>window.location.href=\"$url\";</script>";
}
?>


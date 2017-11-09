<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:37
 */
require '../include/bowen_pdo.php';
if ($_POST) {
    $id = $_POST['id'];
    $pwd = md5($_POST['pwd']);
    $reIP = $_SERVER["REMOTE_ADDR"];
    $a = new bowen_pdo();
    $result = $a->user_insert(array($id, $pwd, $reIP));
    if ($result == 1) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
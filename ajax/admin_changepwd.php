<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:10
 */
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
require '../admin_session_check.php';
$oldpwd = md5($_POST['oldpwd']);
$newpwd = md5($_POST['newpwd']);
$aid = $_POST['admin_id'];
$oldpwdquery = $a->pwd_query("admin", array($aid));
if ($oldpwdquery[0] != $oldpwd) {
    echo 'pwderror';
} else if ($oldpwd == $newpwd) {
    echo 'same';
} else {
    $stmt = $a->pwd_update("admin", array($newpwd, $aid));
    if ($stmt == 1) {
        echo 'success';
    }
}

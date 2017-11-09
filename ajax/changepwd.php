<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:10
 */
$oldpwd = md5($_POST['oldpwd']);
$newpwd = md5($_POST['newpwd']);
$uid = $_POST['uid'];
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
$oldpwdquery = $a->pwd_query("user", array($uid));
if ($oldpwdquery[0] != $oldpwd) {
    echo 'pwderror';
} else if ($oldpwd == $newpwd) {
    echo 'same';
} else {
    $stmt = $a->pwd_update("user", array($newpwd, $uid));
    if ($stmt == 1) {
        echo 'success';
    }
}

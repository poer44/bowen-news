<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1 0001
 * Time: 下午 2:18
 */
require '../manage/admin_session_check.php';
require '../include/bowen_pdo.php';
$lock=new bowen_pdo();
$stateint =$lock->lock_query();
if ($stateint == '0') {
    if ($lock->lock_update(array(1)) == 1) {
        echo 'lock';
    }
}
else {
    if ($lock->lock_update(array(0)) == 1) {
        echo 'unlock';
    }
}
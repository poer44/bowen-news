<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1 0001
 * Time: 下午 2:07
 */
require './include/bowen_pdo.php';
$lock = new bowen_pdo();
if ($lock->lock_query() == 1) {
    require '404.html';
    exit;
}
?>
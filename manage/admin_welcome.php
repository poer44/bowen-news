<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1 0001
 * Time: 上午 9:16
 */
require './admin_session_check.php';
$admin_id = $_SESSION['admin_id'];
require '../include/bowen_pdo.php';
$a=new bowen_pdo();
//取得评论数
$commentcount=$a->admincount_query("comment");
//取得注册用户数
$usercount=$a->admincount_query("user");
//取得网站状态
$stateint=$a->lock_query();
if($stateint=='0'){
    $state='正常';
}
else{
    $state='维护';
}
require './admin_welcome.html';
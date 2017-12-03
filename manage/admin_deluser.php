<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11 0011
 * Time: 上午 9:47
 */
require './admin_session_check.php';
require '../include/bowen_pdo.php';
$a=new bowen_pdo();
$id=$_GET['id'];
//删除用户照片
$picload=$a->user_query(array($id));
if($picload['user_pic']!="user_pic/user_default.png") {
    $picload='../'.$picload['user_pic'];
    unlink($picload);
}
//删除用户
$a->user_del(array($id));
header('location:admin_user.php?p=1');
?>
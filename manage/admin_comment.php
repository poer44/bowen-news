<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 上午 8:52
 */
require './admin_session_check.php';
require '../include/bowen_pdo.php';
//取得评论信息
$a = new bowen_pdo();
$commentdata = $a->usercomment_query("all", null);
require './admin_comment.html';
?>

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
$a=new bowen_pdo();
$commentdata = $a->usercomment_query("all",null);
//取得讨论列表
$tidlist=array();
$talkidlist = $a->talknews_query("idlist",null);
foreach($talkidlist as $k=>$v){
    array_push($tidlist,$v["id"]);
}
require './admin_comment.html';
?>

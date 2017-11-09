<?php
require './404.php';
if (!isset($_SESSION)) {
    session_start();
}
$a = new bowen_pdo();
//取得分类
$arr[] = $a->sort_query("all", null);
//取得banner数据
$bannerdata = $a->allnews_query("where", array("sort_id", "7"));
$bcount = count($bannerdata);
//取得最新发布
$new = $a->allnews_query("orderby_limit", array("addtime"));
//取得最多点赞
$sup = $a->allnews_query("orderby_limit", array("support_count"));
//取得讨论区
$talkdata = $a->talknews_query("limit5", null);
include './include/nav.php';
require './include/index.html';
?>

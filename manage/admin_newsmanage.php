<?php
require './admin_session_check.php';
require '../include/page.php';
//显示页数
$p = isset($_GET['p']) ? (int)($_GET['p']) : 1;
$sort=isset($_GET['sort'])?$_GET['sort']:null;
//取得页码
if ($sort==null) {
    $a = new page();
    $page = $a->adminnews_page("count", null,null);
    if ($p > $page || $p <= 0 || $page == 0) {
        echo '暂时没有新闻';
        echo '<br>';
        echo "<button type=\"button\" onclick=\"javascript:window.location.href='admin_addnews.php'\">添加新闻&讨论</button>";
    } else {
//取得搜索结果并分页
        $data = $a->adminnews_page("limit", $p,null);
        $sort_id=null;
    }
}
else{
    $sort_id=$_GET['sort'];
    $a = new page();
    $page = $a->adminnews_page("sort_count", null,array($sort_id));
    if ($p > $page || $p <= 0 || $page == 0) {
        echo '暂时没有新闻';
        echo '<br>';
        echo "<button type=\"button\" onclick=\"javascript:window.location.href='admin_addnews.php'\">添加新闻&讨论</button>";
    } else {
//取得搜索结果并分页
        $data = $a->adminnews_page("sort_limit", $p,array($sort_id));
    }
}
require './admin_newslist.html';
?>
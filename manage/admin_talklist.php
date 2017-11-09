<?php
require './admin_session_check.php';
require '../include/page.php';
//显示页数
$p = (int)($_GET['p']);
//取得页码
$a = new page();
$page = $a->admintalk_page("count", null);
if ($p > $page || $p <= 0 || $page == 0) {
    echo '暂时没有讨论';
    echo '<br>';
    echo "<button type=\"button\" onclick=\"javascript:window.location.href='admin_addnews.php'\">添加新闻&讨论</button>";
} else {
//取得搜索结果并分页
    $data = $a->admintalk_page("limit", $p);
    require './admin_talklist.html';
}
?>
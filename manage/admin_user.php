<?php
require './admin_session_check.php';
require '../include/page.php';
$a = new page();
$p = (int)($_GET['p']);
//取得页码
$page = $a->adminuser_page("count", null, null);
if ($p > $page) {
    echo '暂时没有用户';
} else {
//取得搜索结果并分页
    if ($page != 0) {
        $data = $a->adminuser_page("limit", null, $p);
    }
    require 'admin_user.html';
}
?>

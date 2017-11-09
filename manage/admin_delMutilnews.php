<?php
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
//获取待查看的新闻ID
$ids = isset($_POST['id']) ? $_POST['id'] : false;
if (!is_array($ids)) {
}
//过滤输入数组
foreach ($ids as $k => $v) {
    $ids[$k] = (int)$v;
}
//删除新闻的图
foreach ($ids as $id) {
    $src = $a->allnews_query("where", array("id", $id));
    if (!empty($src)) {
        $src = $src[0];
        $src = '../' . $src['pic'];
        unlink($src);
    } else {
        $picload = $a->talknews_query("where", array($id));
        $picload = $picload[0];
        $src = '../' . $picload['pic'];
        unlink($src);
    }
}
foreach ($ids as $v) {
    $a->news_del(array($v));
}
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo "<script>history.go(-1);window.location.reload();</script>";
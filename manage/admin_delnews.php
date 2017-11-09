<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/9/17
 * Time: 22:16
 */
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
//删除新闻图片
$picload = $a->allnews_query("where", array("id", $id));
if (!empty($picload)) {
    $picload = $picload[0];
    $picload = '../' . $picload['pic'];
    unlink($picload);
} else {
    $picload = $a->talknews_query("where", array($id));
    $picload = $picload[0];
    $picload = '../' . $picload['pic'];
    unlink($picload);
}
//删除新闻数据
$a->news_del(array($id));
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo "<script>history.go(-1);window.location.reload();</script>";
?>
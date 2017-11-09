<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/9/17
 * Time: 15:54
 */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
$d = $a->allnews_query("where", array("id", $id));
foreach ($d[0] as $k => $v) {
    $data[$k] = $v;
}
if (empty($data)) {
    echo '新闻id不存在';
    exit;
} else {
    $data['pic'] = '../' . $data['pic'];
    require './admin_shownews.html';
}
?>
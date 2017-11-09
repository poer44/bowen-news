<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 上午 11:06
 */
require './404.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_GET) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $a = new bowen_pdo();
    $d = $a->allnews_query("where", array("id", $id));
    if (empty($d)) {
        require './500.html';
    } else {
        foreach ($d[0] as $k => $v) {
            $data[$k] = $v;
        }
        $commentdata = $a->usercomment_query("news", array($id));
        include './include/nav.php';
        require './include/newsview.html';
    }
} else {
    require './500.html';
}
?>


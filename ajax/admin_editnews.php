<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 下午 7:45
 */
require '../manage/admin_session_check.php';
if ($_POST) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sortid = $_POST['sortid'];
    $imgsrc = $_POST['imgsrc'];
    $oldimgsrc = $_POST['oldimgsrc'];
    $admin_id = $_SESSION['admin_id'];
    require '../include/bowen_pdo.php';
    $a = new bowen_pdo();
    if ($imgsrc == '0') {
        $stmt = $a->news_update("oldpic", array($title, $content, $sortid, $id));
        if ($stmt == 1) {
            echo 'success';
        }
    } else {
        unlink($oldimgsrc);
        $stmt = $a->news_update("newpic", array($title, $content, $sortid, $imgsrc, $id));
        if ($stmt == 1) {
            echo 'success';
        }
    }
}
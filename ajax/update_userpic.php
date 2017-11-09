<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 下午 7:45
 */
if ($_POST) {
    $oldimg = $_POST['oldimg'];
    $imgsrc = $_POST['imgsrc'];
    if (!isset($_SESSION)) {
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    if ($oldimg != 'user_pic/user_default.png') {
        unlink('../' . $oldimg);
    }
    require '../include/bowen_pdo.php';
    $a = new bowen_pdo();
    $stmt = $a->user_update("pic", array($imgsrc, $user_id));
    $_SESSION['userpic'] = $imgsrc;
    if ($stmt == 1) {
        echo 'success';
    }
}
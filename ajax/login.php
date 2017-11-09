<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:37
 */
require '../include/bowen_pdo.php';
if ($_POST) {
    $id = $_POST['id'];
    $pwd = md5($_POST['pwd']);
    $a = new bowen_pdo();
    $stmt = $a->user_query(array($id));
    if ($stmt == null) {
        echo 'querynull';
    } else {
        if ($stmt['user_pwd'] == $pwd) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $reIP = $_SERVER["REMOTE_ADDR"];
            $a->user_update("ip", array('0', $id));//更新时间
            $a->user_update("ip", array($reIP, $id));
            $_SESSION['user_id'] = $id;
            $_SESSION['userpic'] = $stmt['user_pic'];
            echo 'success';
        } else {
            echo 'pwderror';
        }
    }
}
?>
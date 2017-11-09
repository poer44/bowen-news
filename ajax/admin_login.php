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
    $stmt = $a->pwd_query("admin", array($id));
    if ($stmt == null) {
        echo 'querynull';
    } else {
        if ($stmt['admin_pwd'] == $pwd) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['admin_id'] = $id;
            echo 'success';
        } else {
            echo 'pwderror';
        }
    }
}
?>
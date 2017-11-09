<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/9/17
 * Time: 16:26
 */
require('./admin_session_check.php');
require '../include/bowen_pdo.php';
if ($_GET) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $a = new bowen_pdo();
    $data = $a->allnews_query("where", array("id", $id));
    if (empty($data)) {
        echo '非法操作';
    } else {
        $data = $data[0];
        $arr = $a->sort_query("all", null);
        $data['pic'] = '../' . $data['pic'];
        require './admin_editnews.html';
    }
}
?>
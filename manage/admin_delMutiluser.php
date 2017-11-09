<?php
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
$ids = isset($_POST['id']) ? $_POST['id'] : false;
//删除用户头像
foreach ($ids as $id) {
    $src = $a->user_query(array($id));
    if ($src['user_pic'] != "user_pic/user_default.png") {
        $src = '../' . $src['user_pic'];
        unlink($src);
    }
}
//删除用户记录
foreach ($ids as $v) {
    $a->user_del(array($v));
}

header('Location: admin_user.php?p=1');
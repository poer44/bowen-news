<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 上午 11:06
 */
require './404.php';
if ($_GET) {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id']=null;
    }
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id != null) {
        if ($_SESSION['user_id'] == $id) {
            //取得用户信息
            $a = new bowen_pdo();
            $data = $a->user_query(array($id));
            //取得评论信息
            $commentdata = $a->usercomment_query("user",array($id));
            //取得讨论列表
            $tidlist=array();
            $talkidlist = $a->talknews_query("idlist",null);
            foreach($talkidlist as $k=>$v){
                array_push($tidlist,$v["id"]);
            }
            require './include/user_home.html';
            include './include/nav.php';
        } //判断用户。如果本人跳个人中心页，非本人跳个人信息页
        else {
            $url = './user_view.php?id=' . $id;
            echo "<script>window.location.href=\"$url\";</script>";
        }
    } else {
        require './500.html';
    }
} else {
    require './500.html';
}
?>


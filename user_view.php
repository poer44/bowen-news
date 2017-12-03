<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 上午 9:23
 */
require './404.php';
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!isset($_SESSION)) {
        session_start();
    }
    //取得用户信息
    if ($id != null) {
        $a = new bowen_pdo();
        $userinfo = $a->user_query(array($id));
            if (empty($userinfo)) {
                require './500.html';
            } else {
                //取得评论信息
                $commentdata = $a->usercomment_query("user",array($id));
                //取得讨论列表
                $tidlist=array();
                $talkidlist = $a->talknews_query("idlist",null);
                foreach($talkidlist as $k=>$v){
                    array_push($tidlist,$v["id"]);
                }
                require './include/user_view.html';
                include './include/nav.php';
            }
    } else {
        require './500.html';
    }


} else {
    require './500.html';
}

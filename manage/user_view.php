<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 上午 9:23
 */
if ($_GET) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    //取得用户信息
    if ($id != null) {
        require '../include/bowen_pdo.php';
        $a = new bowen_pdo();
        $userinfo = $a->user_query(array($id));
        $userinfo['user_pic'] = '../' . $userinfo['user_pic'];
        //取得评论信息
        $commentdata = $a->usercomment_query("user", array($id));
        //取得讨论列表
        $tidlist=array();
        $talkidlist = $a->talknews_query("idlist",null);
        foreach($talkidlist as $k=>$v){
            array_push($tidlist,$v["id"]);
        }
        require 'admin_userview.html';
    }
}
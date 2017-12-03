<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 上午 9:01
 * var arr = {comid: comid, recev_user: recev_user, send_user: send_user, replys: reply, red: red};
 */
if ($_POST) {
    require('../include/user_session_check.php');
    require '../include/bowen_pdo.php';
    $news_id=$_POST['news_id'];
    $comid = $_POST['comid'];
    $recev_user = $_POST['recev_user'];
    $send_user = $_POST['send_user'];
    $replys = $_POST['replys'];
    $replys =trim($replys);
    $replys =preg_replace('/[\n]/', '', $replys);
    $replys =preg_replace('/[ ]/', '', $replys);
    $replys=str_replace("<br>","&lt;br&gt;",$replys);
    $replys=str_replace("<br/>","&lt;br/&gt;",$replys);
    $replys=str_replace('"',"“",$replys);
    $replys=str_replace("'","‘",$replys);
    $red = $_POST['red'];
    $red=str_replace("&lt;a","<a",$red);
    $red=str_replace("&gt;",">",$red);
    $red=str_replace("&lt;/a","</a",$red);
    $user_url="<a href=user_home.php?id=".$recev_user.">".$recev_user."</a>";
    $truereplys=$replys.' // @'.$user_url.':'.$red;
    $a=new bowen_pdo();
    $result = $a->comment_insert(array($news_id,$send_user,$truereplys));
    $a->reply_insert(array($send_user,$recev_user,'0',$result));
}
?>
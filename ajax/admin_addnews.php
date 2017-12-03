<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 下午 7:45
 */
require '../manage/admin_session_check.php';
if($_POST){
    $title=$_POST['title'];
    $content=$_POST['content'];
    $sortid=$_POST['sortid'];
    $imgsrc=$_POST['imgsrc'];
    $admin_id=$_SESSION['admin_id'];
    require '../include/bowen_pdo.php';
    $a=new bowen_pdo();
    $stmt=$a->news_insert(array($title,$content,$imgsrc,$admin_id,$sortid));
    if($stmt==1){
        echo 'success';
    }
}
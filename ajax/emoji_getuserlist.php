<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/10/29
 * Time: 18:19
 */
$likelock=0;
$hatelock=0;
require '../include/bowen_pdo.php';
$a=new bowen_pdo();
$news_id=$_POST['news_id'];
$user_id=$_POST['user_id'];
$data=$a->userop_query(array($news_id));
$jsondata=json_decode($data['userop_json'],true);
foreach ($jsondata['like'] as $v){
    if($v==$user_id){
        $likelock=1;
        break;
    }
}
foreach ($jsondata['hate'] as $v){
    if($v==$user_id){
        $hatelock=1;
        break;
    }
}
if($likelock==1&&$hatelock==0){
    echo 'likelock';
}
else if($likelock==0&&$hatelock==1){
    echo 'hatelock';
}
else if($likelock==1&&$hatelock==1){
    echo 'bothlock';
}
else{
    echo 'none';
}
?>
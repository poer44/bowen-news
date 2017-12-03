<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 下午 2:09
 */
require '../include/bowen_pdo.php';
$a=new bowen_pdo();
$q=$_GET['q'];
$data=$a->user_query(array($q));
if(empty($data)){
    $response = "ok";
}
else{
    $response = "exist";
}
echo $response;
?>

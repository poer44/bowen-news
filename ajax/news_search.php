<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24 0024
 * Time: 下午 2:05
 */
$info = $_POST['search'];
$s = '%' . $info . '%';
require '../include/bowen_pdo.php';
$a = new bowen_pdo();
$data = $a->allnews_query("title", array($s, $s));
$json = json_encode($data);
echo $json;
?>
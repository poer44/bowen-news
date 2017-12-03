<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10 0010
 * Time: 下午 2:59
 */
require './admin_session_check.php';
require('../include/bowen_pdo.php');
$a=new bowen_pdo();
$arr=$a->sort_query("all",null);
require('./admin_addnews.html');
?>

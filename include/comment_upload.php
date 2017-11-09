<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27 0027
 * Time: 上午 9:47
 */
if ($_POST) {
    require('../include/user_session_check.php');
    $content = $_POST['content'];
    $content = trim($content);
    $content = preg_replace('/[\n]/', '', $content);
    $content = preg_replace('/[ ]/', '', $content);
    $content = str_replace("<", "&lt;", $content);
    $content = str_replace(">", "&gt;", $content);
    $content = str_replace('"', "“", $content);
    $content = str_replace("'", "‘", $content);
    $userid = $_SESSION['user_id'];
    $newsid = $_POST['news_id'];
    $precom = $_POST['precomment'];
    require '../include/bowen_pdo.php';
    $a = new bowen_pdo();
    $a->comment_insert(array($newsid, $userid, $content));
    echo "<Script>url=\"../newsview.php?id=$newsid#$precom\";window.location.href=url;</Script>";
}
?>
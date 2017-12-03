<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24 0024
 * Time: 下午 6:40
 */
if ($_GET) {
    if(!isset($_SESSION)){
        session_start();
    }
    $comment_id = isset($_GET['comment_id']) ? $_GET['comment_id'] : null;
    require '../include/bowen_pdo.php';
    $a=new bowen_pdo();
    if (!isset($_SESSION['admin_id'])) {
        require '../include/user_session_check.php';
        $uid = isset($_GET['uid']) ? $_GET['uid'] : null;
        if ($uid == $user_check) {
            if ($comment_id != null) {
                $stmt = $a->comment_del(array($comment_id));
                if ($stmt == 1) {
                    echo 'success';
                } else {
                    echo 'fail';
                }
            }
        }
    } else {
        if ($comment_id != null) {
            $stmt = $a->comment_del(array($comment_id));
            if ($stmt == 1) {
                echo 'success';
            } else {
                echo 'fail';
            }
        }
    }
}
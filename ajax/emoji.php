<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 下午 2:09
 */
if ($_GET) {
    $id = $_GET["id"];
    $userid = $_GET["user"];
    require '../include/bowen_pdo.php';
    $a = new bowen_pdo();
    $response = 0;
    $q = isset($_GET["like"]) ? ($_GET["like"]) : null;
    $h = isset($_GET["hate"]) ? $_GET["hate"] : null;
    if ($userid == null) {
        echo 'login';
    } else {
        if ($h == null) {
            $data = $a->userop_query(array($id));
            $jsondata = json_decode($data['userop_json'], true);
            $lock = 0;
            foreach ($jsondata["like"] as $k => $v) {
                if ($v == "$userid") {
                    $lock = 1;
                }
            }
            if ($lock == 0) {
                array_push($jsondata['like'], $userid);
                $re = json_encode($jsondata);
                $stmt = $a->userop_update("sup", array($q, $re, $id));
                if ($stmt == 1) {
                    $response = 1;
                } else {
                    $response = 0;
                }
            }
        } else {
            $data = $a->userop_query(array($id));
            $jsondata = json_decode($data['userop_json'], true);
            $lock = 0;
            foreach ($jsondata["hate"] as $k => $v) {
                if ($v == "$userid") {
                    $lock = 1;
                }
            }
            if ($lock == 0) {
                array_push($jsondata['hate'], $userid);
                $re = json_encode($jsondata);
                $stmt = $a->userop_update("hate", array($h, $re, $id));
                if ($stmt == 1) {
                    $response = 1;
                } else {
                    $response = 0;
                }
            }
        }
        echo $response;
    }
}
?>

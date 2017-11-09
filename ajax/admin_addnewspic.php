<?php
if ($_POST) {
//生成随机文件名函数
    function random($length)
    {
        $hash = 'news-';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    $uploaddir = "../upfiles/";
    $filename = explode(".", $_FILES['input-b1']['name']);
    do {
        $filename[0] = random(10); //设置随机数长度
        $name = implode(".", $filename);
        $uploadfile = $uploaddir . $name;
    } while (file_exists($uploadfile));
    if (move_uploaded_file($_FILES['input-b1']['tmp_name'], $uploadfile)) {
        if (is_uploaded_file($_FILES['input-b1']['tmp_name'])) {
            echo "{\"imgsrc\":\"\"}";
        } else {
            $uploadfile = substr($uploadfile, 3);
            echo "{\"imgsrc\":\"$uploadfile\"}";
        }
    }
}
?>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7 0007
 * Time: 下午 2:27
 */
require '../include/bowen_pdo.php';
if ($_GET) {
    $id = $_GET['id'] ? (int)$_GET['id'] : null;
    $a = new bowen_pdo();
    $data = $a->talknews_query("where", array($id));
    if (empty($data) || $id == null) {
        require './500.html';
    } else {
        $data = $data[0];
        $talkdata = $a->usercomment_query("news", array($id));
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <title>博闻讨论 - 博闻beta</title>
            <link href="../css/bootstrap.min.css" rel="stylesheet">
            <link href="../css/news_view.css" rel="stylesheet">
        </head>
        <body>
        <div class="container-fluid">

            <div style="text-align: center">
            <h1><img src="../img/comments.png" style="height:70px;width: 70px;">博闻讨论<br><small><?php echo $data['title']; ?></small></h1>
            <img src="<?php echo "../".$data['pic']; ?>" class="img-thumbnail" style="width:480px;height: 320px;"><h2><?php echo $data['content']; ?></h2>
            </div>

        </div>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        </body>
        </html>
    <?php }
} else {
    require './500.html';
}
?>
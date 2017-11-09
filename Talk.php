<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7 0007
 * Time: 下午 2:27
 */
require './404.php';

if ($_GET) {
    $id = $_GET['id'] ? (int)$_GET['id'] : null;
    $a = new bowen_pdo();
    $data = $a->talknews_query("where", array($id));
    if (empty($data) || $id == null) {
        require './500.html';
    } else {
        include './include/nav.php';
        $data = $data[0];
        $talkdata = $a->usercomment_query("news", array($id));
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <title>博闻讨论 - 博闻beta</title>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/news_view.css" rel="stylesheet">
            <link href="css/slide-unlock.css" rel="stylesheet">
        </head>
        <body>
        <div class="container">
            <div style="text-align: center">
                <h1><img src="img/comments.png" style="height:70px;width: 70px;">博闻讨论<br>
                    <small><?php echo $data['title']; ?></small>
                </h1>
                <img src="<?php echo $data['pic']; ?>" class="img-thumbnail" style="width:480px;height: 320px;">
            </div>
            <div class="comment">
                <?php
                if (!isset($_SESSION['user_id'])) {
                    ?>
                    <span class="text-danger">请<a href="login.html">登录</a>后评论</span>
                    <?php
                } else {
                    ?>
                    <img id="spic" class="img-circle" src="<?php echo $_SESSION['userpic'] ?>">
                    <span class="text-primary">请留下您的评论</span>
                    <?php
                }
                ?>
                <form method="post" action="talk_upload.php" onsubmit="return commentempty()">
                    <textarea id="editor_id" name="content"></textarea>
                    <div id="slider">
                        <div id="slider_bg"></div>
                        <span id="label">>></span>
                        <span id="labelTip">右滑解锁评论按钮</span>
                    </div>
                    <div id="c_btn">
                        <button type="submit" class="btn btn-success">评论</button>
                    </div>
                    <input type="hidden" id="precom" name="precomment"
                           value="<?php echo (int)($data['count(details)'] + 1) ?>">
                    <input type="hidden" name="news_id" value="<?php echo $data['id'] ?>"/>
                </form>
            </div>

            <div class="commentlist">
                <table class="table">
                    <?php $i = 0;
                    foreach ($talkdata as $vs): ?>
                        <thead class="c<?php echo $vs['comment_id'] ?>">
                        <div style="display: none">
                            <input type="hidden" id="comid<?php echo $vs['comment_id'] ?>"
                                   value="<?php echo $vs['comment_id'] ?>">
                            <input type="hidden" id="recev<?php echo $vs['comment_id'] ?>"
                                   value="<?php echo $vs['user_id'] ?>">
                            <input type="hidden" id="send<?php echo $vs['comment_id'] ?>"
                                   value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" id="red<?php echo $vs['comment_id'] ?>"
                                   value="<?php echo $vs['details'] ?>">
                        </div>
                        <tr>
                            <?php $i++; ?>
                            <td><a href="user_home.php?id=<?php echo $vs['user_id'] ?>"><img class="img-circle"
                                                                                             src="<?php echo $vs['user_pic'] ?>"
                                                                                             style="width:40px;height: 40px"><span
                                            class="text-info"><?php echo $vs['user_id'] ?></span></a></td>
                            <td><span class="text-info"><?php echo $vs['addtime'] ?></span></td>
                            <td id="<?php echo $i ?>"><span class="text-success"><?php echo "#" . $i ?></span></td>
                            <td>
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    $comid = $vs['comment_id'];
                                    if ($vs['user_id'] == $_SESSION['user_id']) {
                                        $uid = $_SESSION['user_id'];
                                        echo "<a onclick=";
                                        echo "newsview_del($comid,'$uid')";
                                        echo ">删除</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody class="c<?php echo $vs['comment_id'] ?>">
                        <tr>
                            <td colspan="4">
                                <span><?php echo $vs['details'] ?></span>
                            </td>
                        </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script charset="utf-8" src="/editor/kindeditor-all-min.js"></script>
        <script charset="utf-8" src="/editor/lang/zh-CN.js"></script>
        <script src="js/newsview.js"></script>
        <script src="js/jquery.slideunlock.js"></script>
        <script src="js/delcomment.js" ;></script>
        </body>
        </html>
    <?php }
} else {
    require './500.html';
}
?>
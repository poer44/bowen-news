<?php
require './404.php';
require './include/user_session_check.php';
$a = new bowen_pdo();
$message = $a->reply_query(array($user_check));
$a->replyread_update(array(1, $user_check));
include './include/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>消息 - 博闻beta</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-1 visible-lg">
            <img src="img/message.png" class="img-responsive"">
        </div>
        <div class="col-xs-11">
            <h1>消息</h1>
        </div>
    </div>
    <hr>
    <table class="table">
        <?php
        $i = 0;
        foreach ($message as $vs):
            ?>
            <thead style="background-color: #d9edf7">
            <tr>
                <?php $i++; ?>
                <td>
                    <?php if ($vs['read'] == 0) {
                        echo "<span class='glyphicon glyphicon-envelope'>【未读】</span>";
                    } else if ($vs['read'] == 1) {
                        echo "<span class='glyphicon glyphicon-ok'>【已读】</span>";
                    }
                    ?>
                </td>
                <td><a href="newsview.php?id=<?php echo $vs['news_id'] ?>" target="_blank"><span
                                class="text-info">RE:<?php echo $vs['title'] ?></span></a></td>
                <td><span class="text-info"><?php echo $vs['addtime'] ?></span></td>
                <td id="<?php echo $i ?>"><span class="text-success"><?php echo "#" . $i ?></span></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4">
                    <span><?php echo $vs['details'] ?></span>
                </td>
            </tr>
            </tbody>
        <?php endforeach;
        if ($message == null) {
            echo '暂时没有消息';
        }
        ?>
    </table>


</div>
<script src="js/page.js"></script>
</body>
</html>
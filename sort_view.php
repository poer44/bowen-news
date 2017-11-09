<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 上午 10:05
 */
require './404.php';
if ($_GET) {
    header("Content-Type:text/html;charset=UTF-8");
    $sid = isset($_GET['sort_id']) ? $_GET['sort_id'] : null;
    $p = isset($_GET['p']) ? $_GET['p'] : null;
    if ($sid == null || $p == null) {
        require './500.html';
    } else {
//取得sort_name
        $a = new bowen_pdo();
        $sname = $a->sort_query("sort_name", array($sid));
        if (empty($sname)) {
            require './500.html';
        } else {
//取得页码
            require './include/page.php';
            $a = new page();
            $page = $a->sort_page("count", array($sid), null);
            if ($p > $page) {
                require './500.html';
            } else {
//取得分类结果并分页
                $new = $a->sort_page("limit", array($sid), $p);
                include './include/nav.php';
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
                    <title><?php echo $sname[0]; ?> - 博闻beta</title>
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
                    <div class="row" style="text-align: center;background-image: url(img/sort.jpg)">
                        <div class="col-xs-12">
                            <h1><?php echo $sname[0]; ?><h1>
                        </div>
                    </div>
                    <hr>
                    <?php
                    if (!isset($new)) {
                        echo '该分类下暂时无新闻！';
                    } else {
                        foreach ($new as $v) : ?>
                            <div class="row">
                                <a id="newstitle1" href="newsview.php?id=<?php echo $v['id'] ?>" target="_blank">
                                    <div class="col-sm-6">
                                        <img src="<?php echo $v['pic'] ?>" style="height:200px;width:320px;"
                                             class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-6">
                                        <h3><?php echo $v['title'] ?>
                                        </h3>
                                        <div>
                                            <span class="text-info"><?php echo $v['addtime']; ?></span>
                                        </div>
                                        <div>
                                            <img src="img/zan.png"
                                                 style="width: 20px;height:20px"><?php echo $v['support_count']; ?>
                                            <img src="img/dislike.png"
                                                 style="width: 20px;height:20px"><?php echo $v['hate_count']; ?>
                                            <img src="img/comments.png"
                                                 style="width: 20px;height:20px"><?php echo $v['count(details)']; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                        <div style="text-align: center">
                            <ul class="pagination">
                                <?php if (($p - 1) != 0) { ?>
                                    <li><a href="sort_view.php?sort_id=<?php echo $sid ?>&p=<?php echo $p - 1; ?>"><span
                                                    class="glyphicon glyphicon-chevron-left"></span></a></li>
                                <?php } else { ?>
                                    <li class="disabled"><span class="glyphicon glyphicon-chevron-left"></span></li>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $page; $i++) { ?>
                                    <li>
                                        <a href="sort_view.php?sort_id=<?php echo $sid ?>&p=<?php echo $i ?>"><?php echo $i ?></a>
                                    </li>
                                <?php } ?>
                                <?php if ($p != $page) { ?>
                                    <li><a href="sort_view.php?sort_id=<?php echo $sid ?>&p=<?php echo $p + 1; ?>"><span
                                                    class="glyphicon glyphicon-chevron-right"></span></a></li>
                                <?php } else { ?>
                                    <li class="disabled"><span class="glyphicon glyphicon-chevron-right"></span></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <script src="js/page.js"></script>
                </body>
                </html>
                <?php
            }
        }
    }
} else {
    require './500.html';
}
?>
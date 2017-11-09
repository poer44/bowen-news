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
$sdata = isset($_GET['search']) ? $_GET['search'] : null;
$s = '%' . $sdata . '%';
$p = isset($_GET['p']) ? (int)$_GET['p'] : 0;
//取得页码
require './include/page.php';
$a = new page();
$page = (int)($a->search_page("count", array($s, $s), null));
$page == 0 ? $p = -1 : $p = $p;
if (($p == -1 || $p > 0) && $sdata != null && $p <= $page){
//取得搜索结果并分页
$new = $a->search_page("limit", array($s, $s), (int)$p);
include './include/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>搜索 - 博闻beta</title>
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
            <img src="img/search.png" class="img-responsive"">
        </div>
        <div class="col-xs-11">
            <h1>搜索结果
                <small><?php echo $sdata; ?></small>
            </h1>
        </div>
    </div>
    <hr>
    <?php
    if ($page == 0) {
        echo '没有搜索结果！';
    } else {
        foreach ($new as $v) : ?>
            <div class="row">
                <a id="newstitle1" href="newsview.php?id=<?php echo $v['id'] ?>" target="_blank">
                    <div class="col-sm-6">
                        <img src="<?php echo $v['pic'] ?>" style="height:200px;width:320px;" class="img-thumbnail">
                    </div>
                    <div class="col-sm-6">
                        <h3><?php echo $v['title'] ?>
                        </h3>
                        <div>
                            <span class="text-info"><?php echo $v['addtime']; ?></span>
                        </div>
                        <div>
                            <img src="img/zan.png" style="width: 20px;height:20px"><?php echo $v['support_count']; ?>
                            <img src="img/dislike.png" style="width: 20px;height:20px"><?php echo $v['hate_count']; ?>
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
                    <li><a href="searchresult.php?search=<?php echo $sdata ?>&p=<?php echo $p - 1; ?>"><span
                                    class="glyphicon glyphicon-chevron-left"></span></a></li>
                <?php } else { ?>
                    <li class="disabled"><span class="glyphicon glyphicon-chevron-left"></span></li>
                <?php } ?>
                <?php for ($i = 1; $i <= $page; $i++) { ?>
                    <li><a href="searchresult.php?search=<?php echo $sdata ?>&p=<?php echo $i ?>"><?php echo $i ?></a>
                    </li>
                <?php } ?>
                <?php if ($p != $page) { ?>
                    <li><a href="searchresult.php?search=<?php echo $sdata ?>&p=<?php echo $p + 1; ?>"><span
                                    class="glyphicon glyphicon-chevron-right"></span></a></li>
                <?php } else { ?>
                    <li class="disabled"><span class="glyphicon glyphicon-chevron-right"></span></li>
                <?php } ?>
            </ul>
        </div>
        <?php
    }
    }
    else {
        require '500.html';
    }
    }
    else {
        require '500.html';
    }
    ?>
</div>
<script src="js/page.js"></script>
</body>
</html>

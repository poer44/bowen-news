<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 下午 2:01
 */
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $ui = $_SESSION['user_id'];
    $a=new bowen_pdo();
    $newmsg =$a->replycount_query(array($ui,'0'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/nav.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../index.php">&emsp;<img src="../img/bowen11252.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <form class="navbar-form navbar-left" role="search" id="ss" action="../searchresult.php"
                  onsubmit="return search_check();" target="_blank">
                <div class="form-group">
                    <input type="text" class="form-control" list="advice" id="search" name="search"
                           placeholder="Search">
                    <datalist id="advice"></datalist>
                </div>
                <input type="hidden" value="1" name="p"/>
                <button type="submit" class="btn btn-primary" id="sbtn"><span
                            class="glyphicon glyphicon-search">搜索</span></button>
            </form>
            <?php
            if (!isset($_SESSION['user_id'])) {
                ?>
                <ul class="nav navbar-nav navbar-right" id="loginbar">
                    <li><a href="../reg.html"><span class="glyphicon glyphicon-user"></span> 注册</a></li>
                    <li><a href="../login.html"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                </ul>
                <?php
            } else {
                ?>
                <ul class="nav navbar-nav navbar-right" id="loginbar2">
                    <li><a href="../user_home.php?id=<?php echo $_SESSION['user_id'] ?>">
                            <p class="navbar-right" id="userinfo"><img id="userpic"
                                                                       src="<?php echo $_SESSION['userpic'] ?>"
                                                                       class="img-circle"><?php echo $_SESSION['user_id'] ?>
                            </p>
                        </a></li>
                    <li><a href="../message.php"><span id="msg"
                                                                       class="glyphicon glyphicon-envelope">消息(<?php echo $newmsg; ?>)</span></a></li>
                    <li><a href="include/logout.php"><span class="glyphicon glyphicon-off" id="logout">登出</span></a></li>
                </ul>
                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" id="uid">
                <?php
            }
            ?>
        </div>
    </div>
</nav>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/search.js"></script>
</body>
</html>


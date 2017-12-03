<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博闻后台</title>
    <link href="../css/admin_index.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php require('./admin_session_check.php'); ?>
<div id="top">
    <div id="logo">
        <a href="admin_home.php"><img src="../img/houtai.png" id="logoimg"/></a>
    </div>
</div>
<div class="btn-group">
    <button type="button" class="btn btn-danger dropdown-toggle " data-toggle="dropdown">
        管理员 <?php echo $_SESSION['admin_id'] ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="admin_changepwd.php" target="rightifrane">更改密码</a>
        </li>
        <li>
            <a href="admin_logout.php" target="_parent">退出登陆</a>
        </li>
    </ul>
</div>
<div id="mid">
    <div id="left" style="background-color: black;opacity: 0.8">
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="admin_welcome.php" target="rightifrane"><span class="glyphicon glyphicon-file"></span>欢迎界面</a></li>
            <li><a href="admin_newsmanage.php?p=1" target="rightifrane"><span class="glyphicon glyphicon-file">新闻管理</span></a></li>
            <li><a href="admin_talklist.php?p=1" target="rightifrane"><span class="glyphicon glyphicon-file">讨论管理</span></a></li>
            <li><a href="admin_comment.php" target="rightifrane"><span class="glyphicon glyphicon-file">评论管理</span></a></li>
            <li><a href="admin_user.php?p=1" target="rightifrane"><span class="glyphicon glyphicon-file"></span>用户管理</a></li>
        </ul>
    </div>
    <div id="right">
        <iframe src="admin_welcome.php" id="rightifrane" name="rightifrane">
        </iframe>
    </div>
</div>
<script>
    $(function () {
        $(".nav li").click(function () {
            $('.nav li').removeClass("active");
            $(this).addClass("active");
        });
    })
</script>
</body>
</html>
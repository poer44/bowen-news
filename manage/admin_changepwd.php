<?php require './admin_session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/admin_pwdupdate.js"></script>
    <script src="../js/pwdcheck.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="alert" id="tips">
        <span id="tipstext"><strong>警告！</strong>您的网络连接有问题。</span>
    </div>
    <form method="post">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>
                    <?php
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    echo '<span class="glyphicon glyphicon-user text-primary">管理员' . $_SESSION['admin_id'] . '</span>'; ?>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="password" class="form-control" id="oldpwd" placeholder="原密码"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" class="form-control" id="newpwd" placeholder="新密码"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" class="form-control" id="cnewpwd" placeholder="确认密码"/>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" type="button" onclick="admin_pwdupdate()">提交</button>
                    <button class="btn btn-danger" type="reset">重设</button>
                </td>
            </tr>
        </table>
        <input type="hidden" id="aid" value="<?php echo $_SESSION['admin_id']; ?>">
    </form>
</div>
</body>
</html>
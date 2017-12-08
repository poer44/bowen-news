<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/11/5
 * Time: 15:00
 */

class bowen_pdo
{
    public $host = "127.0.0.1";
    public $uid = "root";
    public $pwd = "root";
    public $dbname = "project_news";
    public $charset = "utf8";

    public function allnews_query($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "orderby") {
            $sql = "SELECT * FROM news_all order by $arr[0] desc";
            $sth = $pdo->query($sql);
        }
        else if ($key == "orderby_limit") {
            $sql = "SELECT * FROM news_all order by $arr[0] desc limit 0,10";
            $sth = $pdo->query($sql);
        }
        else if ($key == "where") {
            $sth = $pdo->prepare("select * from news_all where $arr[0] = ?");
            $sth->execute(array($arr[1]));
        } else if ($key == "title") {
            $sql = " select title from news where (content like ? or title like ?)";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function talknews_query($key,$arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if($key=="all") {
            $sql = "select * from news_talk where sort_id=8";
            $sth = $pdo->prepare($sql);
        }
        else if($key=="limit5"){
            $sql="select * from news_talk where sort_id=8 order by addtime desc limit 0,5";
            $sth = $pdo->query($sql);
        }
        else if($key=="where"){
            $sql="select * from news_talk where id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
        }
        else if($key=="idlist"){
            $sql="select id from news_talk";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sort_query($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "all") {
            $sql = "SELECT * FROM `sort`";
            $sth = $pdo->query($sql);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($key == "sort_name") {
            $sql = "SELECT sort_name FROM `sort`  where sort_id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            return $sth->fetch();
        }
    }

    public function userop_query($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("select userop_json from support where news_id=?");
        $sth->execute($arr);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function user_query($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("select * from user where user_id = ? ");
        $sth->execute($arr);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function usercomment_query($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "user") {
            $sth = $pdo->prepare("select * from comment_title where user_id = ? ");
            $sth->execute($arr);
        } else if ($key == "news") {
            $sth = $pdo->prepare("select * from comment_title where news_id = ? order by addtime asc");
            $sth->execute($arr);
        } else if ($key == "all") {
            $sth = $pdo->query("select * from comment_title order by addtime desc");
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lock_query()
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->query("select `lock` from state")->fetchColumn(0);
        return $sth;
    }

    public function lock_update($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("update state set `lock`=?");
        return $sth->execute($arr);
    }
    public function userop_update($key,$arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if($key=="sup") {
            $sth = $pdo->prepare("update support set support_count=?,userop_json=? where news_id=?");
        }
        else if($key=="hate"){
            $sth = $pdo->prepare("update support set hate_count=?,userop_json=? where news_id=?");
        }
        return $sth->execute($arr);
    }

    public function admincount_query($str)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($str == "comment") {
            $sql = "select count(comment_id) from comment";
        } else if ($str == "user") {
            $sql = "select count(`user_id`) from user";
        }
        return $pdo->query($sql)->fetchColumn(0);
    }

    public function reply_query($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("select * from reply_news where recev_user=? order by `read`,addtime desc");
        $sth->execute($arr);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function replycount_query($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("select count(id) from reply_comment where recev_user=? and `read`=?");
        $sth->execute($arr);
        return $sth->fetchColumn(0);
    }

    public function replyread_update($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("update reply_comment set `read`=? where recev_user=?");
        return $sth->execute($arr);
    }

    public function pwd_query($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "admin") {
            $sql = "select admin_pwd from admin where admin_id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
        } else if ($key == "user") {
            $sql = "select user_pwd from `user` where user_id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
        }
        return $sth->fetch();

    }

    public function pwd_update($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "admin") {
            $sql = "update admin set admin_pwd=? where admin_id=?";
            $sth = $pdo->prepare($sql);
        } else if ($key == "user") {
            $sql = "update user set user_pwd=? where user_id=?";
            $sth = $pdo->prepare($sql);
        }
        return $sth->execute($arr);
    }

    public function user_insert($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sql = "insert into user(user_id,user_pwd,user_ip) values(?,?,?)";
        $sth = $pdo->prepare($sql);
        return $sth->execute($arr);
    }

    public function comment_insert($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sql = "insert into comment(news_id,user_id,details) values(?,?,?)";
        $sth = $pdo->prepare($sql);
        $sth->execute($arr);
        return $pdo->lastInsertId();

    }

    public function reply_insert($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sql = "insert into reply_comment(send_user,recev_user,`read`,reply_commentid) values(?,?,?,?)";
        $sth = $pdo->prepare($sql);
        return $sth->execute($arr);
    }

    public function news_insert($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sql = "insert into news(title,content,pic,admin_id,sort_id) values(?,?,?,?,?)";
        $sth = $pdo->prepare($sql);
        return $sth->execute($arr);
    }

    public function user_update($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "ip") {
            $sql = "update user set `user_ip` =?  where `user_id`=?";
            $sth = $pdo->prepare($sql);
        } else if ($key == "pic") {
            $sql = "update user set user_pic=? where user_id=?";
            $sth = $pdo->prepare($sql);
        }
        return $sth->execute($arr);
    }

    public function news_update($key, $arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "oldpic") {
            $sql = "update `news` set `title`=?,`content`=?,`sort_id`=? where `id`=?";
            $sth = $pdo->prepare($sql);
        } else if ($key == "newpic") {
            $sql = "update `news` set `title`=?,`content`=?,`sort_id`=?,`pic`=? where `id`=?";
            $sth = $pdo->prepare($sql);
        }
        return $sth->execute($arr);
    }
    public function comment_del($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("delete from comment where comment_id=?");
        return $sth->execute($arr);
    }
    public function user_del($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("delete from `user` where `user_id`=?");
        return $sth->execute($arr);
    }
    public function news_del($arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        $sth = $pdo->prepare("delete from `news` where id=?");
        return $sth->execute($arr);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: poer4
 * Date: 2017/11/5
 * Time: 14:57
 */

class page
{
    public $host = "127.0.0.1";
    public $uid = "root";
    public $pwd = "root";
    public $dbname = "project_news";
    public $charset = "utf8";
    public function search_page($key, $arr, $p)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "SELECT count(*) FROM news_all where title like ? or content like ?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            $page=$sth->fetch();
            return ceil($page[0] / 10);
        } else if ($key == "limit") {
            $p=($p-1)*10;
            $sql = "SELECT * FROM news_all where (title like ? or content like ?) order by addtime desc limit $p,10";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    public function sort_page($key, $arr, $p)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "SELECT count(*) FROM news_all where sort_id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            $page=$sth->fetch();
            return ceil((int)$page[0] / 10);
        } else if ($key == "limit") {
            $p = ($p - 1) * 10;
            $sql = "SELECT * FROM news_all where sort_id=? order by addtime desc limit $p,10";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function talk_page($key, $arr, $p)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "SELECT count(*) FROM news_talk where sort_id=8";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            $page=$sth->fetch();
            return ceil((int)$page[0] / 10);
        } else if ($key == "limit") {
            $p = ($p - 1) * 10;
            $sql = "SELECT * FROM news_talk where sort_id=8 order by addtime desc limit $p,10";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    public function adminnews_page($key, $p,$arr)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "SELECT count(*) FROM news_all";
            $sth = $pdo->query($sql);
            $page = $sth->fetch();
            return ceil($page[0] / 10);
        } else if ($key == "limit") {
            $p = ($p - 1) * 10;
            $sql = "select * from news_all order by `addtime` desc limit $p,10";
            $sth = $pdo->query($sql);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        else if ($key == "sort_limit") {
            $p = ($p - 1) * 10;
            $sql = "select * from news_all where sort_id=? order by `addtime` desc limit $p,10";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($key == "sort_count") {
            $sql = "SELECT count(*) FROM news_all where sort_id=?";
            $sth = $pdo->prepare($sql);
            $sth->execute($arr);
            $page = $sth->fetch();
            return ceil($page[0] / 10);
        }
    }

    public function admintalk_page($key, $p)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "SELECT count(*) FROM news_talk";
            $sth = $pdo->query($sql);
            $page = $sth->fetch();
            return ceil($page[0] / 10);
        } else if ($key == "limit") {
            $p = ($p - 1) * 10;
            $sql = "select * from news_talk order by `addtime` desc limit $p,10";
            $sth = $pdo->query($sql);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    public function adminuser_page($key, $arr, $p)
    {
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $pdo = new PDO($dsn, "$this->uid", "$this->pwd");
        if ($key == "count") {
            $sql = "select count(*) from user";
            $sth = $pdo->query($sql);
            $page = $sth->fetch();
            return ceil($page[0] / 10);
        } else if ($key == "limit") {
            $p = ($p - 1) * 10;
            $sql = "select * from user order by user_lastlogin desc limit $p,10";
            $sth = $pdo->query($sql);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
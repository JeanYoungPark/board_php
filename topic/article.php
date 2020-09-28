<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/config.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/class/mysql.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/class/html.php');

//call datas for article
$mysql = new mysql;
$result = $mysql->query("SELECT * FROM board_table WHERE id=?",[$_GET['id']]);
$row = mysqli_fetch_assoc($result);
$date = date('Y.m.d H:i',$row['date']);

$row['content'] = htmlspecialchars_decode($row['content']);
$_POST['content'] = str_replace('\rn','\n',$_POST['content']);
var_dump($row['content']);

$before_query = "SELECT id FROM board_table
                        WHERE id < ?
                          AND date <= ?
                     ORDER BY id DESC LIMIT 1";
$next_query = "SELECT id FROM board_table
                       WHERE id > ?
                         AND date >= ?
                       LIMIT 1";

//call ids for pages
$result = $mysql->query($before_query, [$row['id'],$row['date']]);
$before = mysqli_fetch_assoc($result);

$result = $mysql->query($next_query, [$row['id'],$row['date']]);
$next = mysqli_fetch_assoc($result);

$btn = '';
if($before) $btn = "<span class='before'><a href='/topic/article.php?id={$before['id']}'><em class='glyphicon glyphicon-chevron-left'></em>이전글</a></span>";
if($next) $btn .= "<span class='next'><a href='/topic/article.php?id={$next['id']}'>다음글<em class='glyphicon glyphicon-chevron-right'></em></a></span>";

$body = <<<JYP
    <script>var data = '{$row['content']}';</script>
    <div class="container">
        <a class="btn btn-default" type="button" href="/"><em class="glyphicon glyphicon-home"></em>홈</a>
        <div class="content-top clearfix">
            <h1>{$row['title']}</h1>
            <div class="clearfix">
                <p class="pull-left">
                    <span>작성자.{$row['writer']}</span>
                    <span class="date">{$date}</span>
                </p>
                <div class="clearfix pull-right">
                    <a class="modify pull-left btn btn-default btn-sm" href="/topic/modify.php?id={$row['id']}">수정</a>
                    <form class="delete pull-left" action="/topic.delete_process.php" method="post">
                        <input type="hidden" name="id" value="{$row['id']}">
                        <input class="btn btn-default btn-sm" type="submit" value="삭제">
                    </form>
                </div>
            </div>
        </div>
        <div class="content-bottom"><p></p></div>
        <div class="pages-btn">{$btn}</div>
    </div>
JYP;

$html = new html($body);
?>
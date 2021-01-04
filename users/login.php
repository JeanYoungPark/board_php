<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/config.php');

$body =<<<JYP
<div class="container">
    <div class="col-lg-4 col-lg-offset-4">
        <form action="/process/login_process.php" method="post">
            <div class="form-group">
                <label for="id">아이디</label>
                <input id="id" class="form-control" type="text" name="id" placeholder="아이디를 입력해주세요.">
            </div>
            <div class="form-group">
                <label for="password">비밀번호</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="비밀번호를 입력해주세요.">
            </div>
            <input class="btn btn-default" type="submit" value="로그인">
        </form>
    </div>
</div>
JYP;

$html = new html($body);
?>
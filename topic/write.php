<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/config.php');

if(isset($GLOBALS['user'])) {
    $body =<<<JYP
    <div class="container">
        <div class="form-container">
            <form id="write_form" action="/process/write_process.php" method="post">
                <div class="form-group">
                    <input id="title" class="form-control" name="title" type="text" placeholder="제목">
                </div>
                <div class="form-group">
                    <textarea class="content-bottom form-control" name="content" placeholder="내용을 입력하세요"></textarea>
                </div>
                <input class="btn btn-default" type="submit" value="저장">
            </form>
        </div>
    </div>
    JYP;

    $html = new html($body);
}else {
    echo("<script>alert('로그인 후 글쓰기가 가능합니다.');location.replace('/users/login.php');</script>"); 
}

?>
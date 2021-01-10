<?php
// 데이터베이스 연결 부
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패");
mysqli_select_db($conn, $db_name) or die("접속 실패");

// 페이지 로직
$sql='select * from board order by board_id desc';
$result=mysqli_query($conn,$sql) or die("쿼리 에러");
$title = '글 목록';

// 콘텐츠 템플릿 호출
ob_start();
include  __DIR__ . '/../../templates/list.html.php';
$output = ob_get_clean();

// 레이아웃 템플릿 호출
include __DIR__.'/../../templates/layout.html.php';

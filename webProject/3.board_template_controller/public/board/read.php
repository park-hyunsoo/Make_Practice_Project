<?php
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패"); 
mysqli_select_db($conn, $db_name) or die("접속 실패");

$id = $_GET['id'];
$sql='select user_id, board_title, board_content  from board where board_id='.$id;
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);

$title='상세보기';
ob_start();
include __DIR__.'/../../templates/read.html.php';
$output = ob_get_clean();
include __DIR__.'/../../templates/layout.html.php';

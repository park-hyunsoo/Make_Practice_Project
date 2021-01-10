<?php
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패"); 
mysqli_select_db($conn, $db_name) or die("접속 실패");

if(isset($_GET['id']) && !isset($_POST['id'])){ // 업데이트 화면
    $id = $_GET['id'];
    $sql='select user_id, board_title, board_content  from board where board_id='.$id;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    
    $title='글 수정';
    ob_start();
    include __DIR__.'/../../templates/update.html.php';
    $output = ob_get_clean();
    include __DIR__.'/../../templates/layout.html.php';
    
} else{ // 업데이트 처리
    $title=$_POST['title'];
    $id=$_POST['id'];
    $name=$_POST['name'];
    $content=$_POST['content'];
    $sql="update board set user_id='{$name}', board_title='{$title}', board_content='{$content}' where board_id ='{$id}'";
    $query_res=mysqli_query($conn,$sql) or die("쿼리 에러");
    header('Location: list.php');
}
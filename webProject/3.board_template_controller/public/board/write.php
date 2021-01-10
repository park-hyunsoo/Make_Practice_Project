<?php
if(!isset($_POST['title'])){
    $title='글쓰기';
    ob_start();
    include __DIR__.'/../../templates/write.html.php';
    $output = ob_get_clean();
    include __DIR__.'/../../templates/layout.html.php';    
}else{
    $db_hostname="localhost";
    $db_username="koot";
    $db_password="rkskek1!";
    $db_name="myWebProject";
    $conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패");
    mysqli_select_db($conn, $db_name) or die("접속 실패");

    $title=$_POST['title'];
    $name=$_POST['name'];
    $content=$_POST['content'];
    $sql="insert into board(user_id, board_title, board_content) values ('$name','$title','$content')";
    $query_res=mysqli_query($conn,$sql) or die("쿼리 에러");
    header('Location: list.php');
}

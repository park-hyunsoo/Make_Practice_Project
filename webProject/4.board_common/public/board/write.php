<?php
if(!isset($_POST['title'])){
    $title='글쓰기';
    ob_start();
    include __DIR__.'/../../templates/write.html.php';
    $output = ob_get_clean();
    include __DIR__.'/../../templates/layout.html.php';    
}else{
    try{
        include_once __DIR__.'/../../includes/dbconnect.php';
    
        $title=$_POST['title'];
        $name=$_POST['name'];
        $content=$_POST['content'];
        $sql="insert into board(user_id, board_title, board_content) values ('$name','$title','$content')";
        $query=$pdo->prepare($sql);
        $query->execute();
        header('Location: list.php');
    }catch(PDOException $e) {
        $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
        $e->getFile() . ':' . $e->getLine();
    }
}

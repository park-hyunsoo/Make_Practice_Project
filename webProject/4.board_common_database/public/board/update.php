<?php
try{
    // 데이터베이스 연결 부
    include_once __DIR__.'/../../includes/dbconnect.php';

    if(isset($_GET['id']) && !isset($_POST['id'])){ // 업데이트 화면
        $id = $_GET['id'];
        $sql='select user_id, board_title, board_content  from board where board_id='.$id;
        $query = $pdo->prepare($sql);
        $query->execute();
        $row=$query->fetch();
    
        $title='글 수정';
        ob_start();
        include __DIR__.'/../../templates/update.html.php';
        $output = ob_get_clean();

    
    } else{ // 업데이트 처리
        $title=$_POST['title'];
        $id=$_POST['id'];
        $name=$_POST['name'];
        $content=$_POST['content'];
        $sql="update board set user_id='{$name}', board_title='{$title}', board_content='{$content}' where board_id ='{$id}'";
        $query = $pdo->prepare($sql);
        $query->execute();
        header('Location: list.php');
    }
}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__.'/../../templates/layout.html.php';
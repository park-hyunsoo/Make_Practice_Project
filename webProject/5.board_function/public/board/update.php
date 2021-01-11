<?php
try{
    include_once __DIR__.'/../../includes/dbconnect.php';
    include_once __DIR__ . '/../../includes/dbfunction.php';

    if(isset($_GET['id']) && !isset($_POST['id'])){ // 업데이트 화면
        $id = $_GET['id'];
        $row=read($pdo, $id);
    
        $title='글 수정';
        ob_start();
        include __DIR__.'/../../templates/update.html.php';
        $output = ob_get_clean();

    
    } else{ // 업데이트 처리
        $title=$_POST['title'];
        $id=$_POST['id'];
        $name=$_POST['name'];
        $content=$_POST['content'];
        update($pdo, $id, $title, $content, $name);
        header('Location: list.php');
    }
}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__.'/../../templates/layout.html.php';
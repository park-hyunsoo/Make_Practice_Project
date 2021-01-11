<?php
try{
    include_once __DIR__.'/../../includes/dbconnect.php';
    include_once __DIR__.'/../../includes/dbCommonFunction.php';

    if(isset($_GET['id']) && !isset($_POST['id'])){ // 업데이트 화면
        $id = $_GET['id'];
        $row=read($pdo, 'board', 'board_id', $id);
    
        $title='글 수정';
        ob_start();
        include __DIR__.'/../../templates/update.html.php';
        $output = ob_get_clean();

    
    } else{ // 업데이트 처리
        update($pdo, 'board', 'board_id', ['board_id'=> $_POST['id'], 'board_title'=>$_POST['title'], 'user_id'=> $_POST['name'], 'board_content' => $_POST['content']]);
        header('Location: list.php');
    }
}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__.'/../../templates/layout.html.php';
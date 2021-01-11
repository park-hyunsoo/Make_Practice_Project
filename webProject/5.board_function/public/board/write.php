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
        include_once __DIR__ . '/../../includes/dbfunction.php';
        
        insert($pdo, ['user_id'=> $_POST['name'], 'board_title'=>$_POST['title'], 'board_content' => $_POST['content']]);
        
        header('Location: list.php');
        
    }catch(PDOException $e) {
        $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
        $e->getFile() . ':' . $e->getLine();
    }
}

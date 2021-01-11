<?php
try{
    // 데이터베이스 연결 부
    include_once __DIR__.'/../../includes/dbconnect.php';

    $id = $_GET['id'];
    $sql='select user_id, board_title, board_content  from board where board_id='.$id;
    $query = $pdo->prepare($sql);
    $query->execute();
    $row=$query->fetch();

    $title='상세보기';
    ob_start();
    include __DIR__.'/../../templates/read.html.php';
    $output = ob_get_clean();

}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__.'/../../templates/layout.html.php';

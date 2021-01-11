<?php
try{
    include_once __DIR__.'/../../includes/dbconnect.php';
    include_once __DIR__.'/../../includes/dbCommonFunction.php';

    $id = $_GET['id'];
    $row=read($pdo, 'board', 'board_id', $id);

    $title='상세보기';
    ob_start();
    include __DIR__.'/../../templates/read.html.php';
    $output = ob_get_clean();

}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__.'/../../templates/layout.html.php';

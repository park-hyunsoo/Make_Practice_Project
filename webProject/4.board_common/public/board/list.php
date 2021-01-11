<?php
try{
    // 데이터베이스 연결 부
    include_once __DIR__.'/../../includes/dbconnect.php';

    // 페이지 로직
    $sql='select * from board order by board_id desc';
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    // 콘텐츠 템플릿 호출
    $title = '글 목록';
    ob_start();
    include  __DIR__ . '/../../templates/list.html.php';
    $output = ob_get_clean();
}catch(PDOException $e) {
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
}

// 레이아웃 템플릿 호출
include __DIR__.'/../../templates/layout.html.php';

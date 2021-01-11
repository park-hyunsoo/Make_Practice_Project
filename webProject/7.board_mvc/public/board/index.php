<?php 
try{ 
    include_once __DIR__.'/../../includes/dbconnect.php'; 
    include_once __DIR__.'/../controllers/boardController.php';    
    $boardController = new BoardController($pdo); 

    
    $action = $_GET['action'] ?? 'lists';
    $page = $boardController->$action();

    if(isset($page)){
        $title = $page['title']; 
        $output = $page['output'];     
    }

}catch(PDOException $e) { 
    $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' . 
    $e->getFile() . ':' . $e->getLine(); 
} 
// 레이아웃 템플릿 호출 
include __DIR__.'/../../templates/layout.html.php';
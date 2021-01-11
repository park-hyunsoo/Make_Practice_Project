<?php
try{
    include_once __DIR__.'/../../includes/dbconnect.php';
    include_once __DIR__.'/../../includes/dbCommonFunction.php';

    if(isset($_GET['id'])){ 
        $id=$_GET['id']; 
        delete($pdo, 'board', 'board_id', $id);
    }
}catch(PDOException $e) {
  $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}
header('Location: list.php');
<?php
try{
    // 데이터베이스 연결 부
    include_once __DIR__.'/../../includes/dbconnect.php';

    if(isset($_GET['id'])){ 
        $id=$_GET['id']; 
        $sql='delete from board where board_id=:id'; 
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}catch(PDOException $e) {
  $error = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}
header('Location: list.php');
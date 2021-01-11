<?php
class BoardController {
    private $pdo;
    const TABLENAME = 'board';

    public function __construct($pdo) {
        $this->pdo = $pdo;
        include __DIR__.'/../../includes/dbCommonFunction.php';
    }

    public function lists(){        
        $result = readAll($this->pdo, self::TABLENAME);
        $title = '글 목록';
        ob_start();
        include  __DIR__.'/../../templates/list.html.php';
        $output = ob_get_clean();
        return ['output' => $output, 'title' => $title];
    }

    public function read(){
        $id = $_GET['id'];
        $row=read($this->pdo, self::TABLENAME, 'board_id', $id);
        $title='상세보기';
        ob_start();
        include __DIR__.'/../../templates/read.html.php';
        $output = ob_get_clean();
        return ['output' => $output, 'title' => $title];
    }

    public function write(){
        if(!isset($_POST['title'])){
            $title='글쓰기';
            ob_start();
            include __DIR__.'/../../templates/write.html.php';
            $output = ob_get_clean();
            return ['output' => $output, 'title' => $title];

        } else{
            insert($this->pdo, self::TABLENAME, ['user_id'=> $_POST['name'], 'board_title'=>$_POST['title'], 'board_content' => $_POST['content']]);
            header('Location: index.php');
        }
    }

    public function update(){
        if(isset($_GET['id']) && !isset($_POST['id'])){ // 업데이트 화면
            $id = $_GET['id'];
            $row=read($this->pdo, self::TABLENAME, 'board_id', $id);
        
            $title='글 수정';
            ob_start();
            include __DIR__.'/../../templates/update.html.php';
            $output = ob_get_clean();
            return ['output' => $output, 'title' => $title];
        
        } else{ // 업데이트 처리
            update($this->pdo, self::TABLENAME, 'board_id', ['board_id'=> $_POST['id'], 'board_title'=>$_POST['title'], 'user_id'=> $_POST['name'], 'board_content' => $_POST['content']]);
            header('Location: index.php');
        }
    }

    public function delete(){
        if(isset($_GET['id'])){ 
            $id=$_GET['id']; 
            delete($this->pdo, self::TABLENAME, 'board_id', $id);
        }
        header('Location: index.php');
    }

}
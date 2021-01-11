<?php
class BaseModel {
    protected $pdo;

    public function __construct(){
        $this->dbConnect();
    }

    private function dbConnect(){
        try{
            $this->pdo=new PDO(_DSN, _DB_USER, _DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $pex){
            die("오류: ".$pex->getMessage());
        }        
    }
}

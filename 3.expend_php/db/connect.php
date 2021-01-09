<?php
  $host = "localhost";
  $user = "koot";
  $pw = "rkskek1!";
  $dbName = "myservice";

  if($this->dbConnection == null){ // 객체 내에 이 파일을 불러들일 것이므로 this를 사용한다.
    $this->dbConnection = new mysqli($host, $user, $pw, $dbName);
    $this->dbConnection->set_charset("utf8");
  }
?>

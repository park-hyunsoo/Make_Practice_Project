<?php
define("_DB_USER", "koot");
define("_DB_PASSWORD", "rkskek1!");
define("_DB_HOST", "localhost");
define("_DB_NAME", "myWebProject");
define("_DB_TYPE", "mysql");
define("_DSN", _DB_TYPE.":host="._DB_HOST."; dbname="._DB_NAME."; charset=utf8");

//회원용 세션명
define("_MEMBER_SESSNAME", "PHPSESSION_MEMBER");
//관리자용 세션명
define("_ADMIN_SESSNAME","PHPSESSION_ADMIN");

//회원용 인증정보를 보관하기 위한 변수명
define("_MEMBER_AUTHINFO", 'userInfo');
//관리자 인증정보를 보관하기 위한 변수명
define("_ADMIN_AUTHINFO",'adminInfo');

?>
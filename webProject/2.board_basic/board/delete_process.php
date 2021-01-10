<?php
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패");
mysqli_select_db($conn, $db_name) or die("접속 실패");

if(isset($_GET['id'])){ 
  $id=$_GET['id']; 
  $sql='delete from board where board_id='.$id; 
  $res=mysqli_query($conn,$sql) or die("쿼리 에러");
}
header('Location: list.php');
?>
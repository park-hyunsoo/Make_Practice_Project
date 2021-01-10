<?php
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패"); 
mysqli_select_db($conn, $db_name) or die("접속 실패");

$id = $_GET['id'];
$sql='select user_id, board_title, board_content  from board where board_id='.$id;
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>board</title>
        <link href="css/reset.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body class="container">
        <header>
            <div class="page-header">
                <h1>Board</h1>
            </div>
        </header>

        <section>
        <div class="panel panel-default">
            <div class="panel-body">
                <form data-coffee-order="form">
                    <div class="form-group">
                        <p>
                            <span>제목</span>
                            <span><?php echo $row['board_title']; ?></span>
                        </p>
                    </div>    
                    <div class="form-group">
                        <p>
                            <span>작성자</span>
                            <span><?php echo $row['user_id']; ?></span>
                        </p>
                    </div>
                    <div class="form-group">
                        <p>본문</p>
                        <p><?php echo $row['board_content']; ?></p>
                    </div>
                <a href="./update.php?id=<?php echo $id; ?>">수정</a>
                <a href="./delete_process.php?id=<?php echo $id; ?>">삭제</a>
                <a href="./list.php">목록</a>
          </form>
        </div>
      </div>
    </section>
  </body>
</html>

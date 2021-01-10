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
                <form method="post" name="board" action="update_process.php">
                    <input type=hidden name=id value="<?=$id; ?>" />
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input class="form-control" name="title" id="title" value="<?php echo $row['board_title'];?>"autofocus>
                    </div>    
                    <div class="form-group">
                        <label for="name">작성자</label>
                        <input class="form-control" name="name" id="name" value="<?php echo $row['user_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">본문</label>
                        <textarea class="form-control" name="content" id="content" rows="3"><?php echo $row['board_content']; ?> </textarea>
                    </div>
                <button type="submit" class="btn btn-default">수정</button>
                <button type="reset" class="btn btn-default">취소</button> 
                </form>
            </div>
        </div>
        </section>
  </body>
</html>

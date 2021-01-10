<?php
$db_hostname="localhost";
$db_username="koot";
$db_password="rkskek1!";
$db_name="myWebProject";
$conn=mysqli_connect($db_hostname, $db_username, $db_password) or die("접속 실패");
mysqli_select_db($conn, $db_name) or die("접속 실패");

$sql='select * from board order by board_id desc';
$res=mysqli_query($conn,$sql) or die("쿼리 에러");
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
    <body>
        <header>
            <div class="page-header">
                <h1>Board</h1>
            </div>
        </header>
        <section>
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <th scope="col"># </th>
                <th scope="col"> 작성자 </th>
                <th scope="col"> 제목 </th>
                <th scope="col"> 날짜 </th>		
            </thead>
            <tbody>               
<?php
while($row=mysqli_fetch_assoc($res))
{
?>
<tr>
    <td><?php echo $row['board_id'];?></td>
    <td><a href="./read.php?id=<?php echo $row['board_id'];?>"><?php echo $row['board_title'];?></a></td>
    <td><?php echo $row['user_id'];?></td>
    <td></td>
    <br/>
</tr>
<?php
}
?>
            </tbody>
        </table>
        <div>
            <a href="./write.php"> 글쓰기 </a>
        </div>
        <div>
            <a href="#"> prev </a>
            <span>
                <a href="#">1</a>
                <a href="#">2</a>
            </span>
            <a href="#"> next </a>
        </div>
        </section>
    </body>
</html>
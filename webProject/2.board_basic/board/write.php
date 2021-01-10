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
                <form method="post" name="board" action="write_process.php">
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input class="form-control" name="title" id="title" autofocus>
                    </div>    
                    <div class="form-group">
                        <label for="name">작성자</label>
                        <input class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="content">본문</label>
                        <textarea class="form-control" name="content" id="content" rows="3"> </textarea>
                    </div>
                <button type="submit" class="btn btn-default">작성</button>
                <button type="reset" class="btn btn-default">취소</button> 
                </form>
            </div>
        </div>
    </section>
  </body>
</html>

<div class="panel panel-default">
    <div class="panel-body">
        <form method="post" name="board" action="">
            <input type=hidden name=id value="<?=$id; ?>" />
            <div class="form-group">
                <label for="title">제목</label>
                <input class="form-control" name="title" id="title" value="<?=$row['board_title'];?>"autofocus>
            </div>    
            <div class="form-group">
                <label for="name">작성자</label>
                <input class="form-control" name="name" id="name" value="<?=$row['user_id'];?>">
            </div>
            <div class="form-group">
                <label for="content">본문</label>
                <textarea class="form-control" name="content" id="content" rows="3"><?=$row['board_content'];?></textarea>
            </div>
            <button type="submit" class="btn btn-default">수정</button>
            <button type="reset" class="btn btn-default">취소</button> 
        </form>
    </div>
</div>

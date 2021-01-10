<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <p>
                <span>제목</span>
                <span><?=$row['board_title']; ?></span>
            </p>
        </div>    
        <div class="form-group">
            <p>
                <span>작성자</span>
                <span><?=$row['user_id']; ?></span>
            </p>
        </div>
        <div class="form-group">
            <p>본문</p>
            <p><?=$row['board_content']; ?></p>
        </div>
        <div class="form-group">
            <a href="./update.php?id=<?=$id; ?>">수정</a>
            <a href="./delete_process.php?id=<?=$id; ?>">삭제</a>
            <a href="./list.php">목록</a>
        </div>
    </div>
</div>


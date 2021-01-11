<table class="table table-hover table-bordered table-sm">
    <thead>
        <th scope="col"># </th>
        <th scope="col"> 제목 </th>
        <th scope="col"> 작성자 </th>
        <th scope="col"> 날짜 </th>		
    </thead>
    <tbody>
    <?php foreach($result as $row): ?>
        <tr>
            <td><?php echo $row['board_id'];?></td>
            <td><a href="./index.php?action=read&&id=<?php echo $row['board_id'];?>"><?php echo $row['board_title'];?></a></td>
            <td><?php echo $row['user_id'];?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div>
    <a href="./index.php?action=write"> 글쓰기 </a>
</div>
<div>
    <a href="#"> prev </a>
    <span>
        <a href="#">1</a>
        <a href="#">2</a>
    </span>
    <a href="#"> next </a>
</div>

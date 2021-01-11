<?php
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalCount($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `board`');
    $row = $query->fetch();
    return $row[0];
}

function insert($pdo, $name, $title, $content) {
    $query = 'INSERT INTO `board` (`user_id`, `board_title`, `board_content`) VALUES (:name, :title, :content)';
    $parameters = [':name' => $name, ':title' => $title, ':content' => $content];
    query($pdo, $query, $parameters);
}

function update($pdo, $id, $title, $content, $name) {
    $parameters = [':title' => $title, ':content' => $content, ':name' => $name, ':id' => $id];
    query($pdo, 'UPDATE `board` SET `user_id` = :name, `board_title` = :title, `board_content` = :content WHERE `board_id` = :id', $parameters);
}
  
function delete($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `board` WHERE `board_id` = :id', $parameters);
}
  
function read($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT `user_id`, `board_title`, `board_content` FROM `board` WHERE `board_id` = :id', $parameters);
    return $query->fetch();
}
  
function readAll($pdo) {
    $query = query($pdo, 'SELECT * FROM `board` ORDER BY `board_id` DESC');
    return $query->fetchAll();
}
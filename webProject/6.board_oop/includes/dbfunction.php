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

function insert($pdo, $fields) {
    $query = 'INSERT INTO `board` (';
    foreach ($fields as $key => $value) {
      $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach ($fields as $key => $value) {
      $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    query($pdo, $query, $fields);
}

function update($pdo, $fields) {
    $sql = ' UPDATE `board` SET ';
    foreach ($fields as $key => $value) {
        $sql .= '`' . $key . '` = :' . $key . ',';
    }
    $sql = rtrim($sql, ',');
    $sql .= ' WHERE `board_id` = :board_id';
    
    query($pdo, $sql, $fields);
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
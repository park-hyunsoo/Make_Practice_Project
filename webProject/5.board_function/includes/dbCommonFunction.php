<?php
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalCount($pdo, $tableName) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `' . $tableName . '`');
    $row = $query->fetch();
    return $row[0];
}

function insert($pdo, $tableName, $fields) {
    $query = 'INSERT INTO `' . $tableName . '` (';
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

function update($pdo, $tableName, $primaryKey, $fields) {
    $sql = ' UPDATE `' . $table . '`  SET ';
    foreach ($fields as $key => $value) {
        $sql .= '`' . $key . '` = :' . $key . ',';
    }
    $sql = rtrim($sql, ',');
    $sql .= ' WHERE `' . $primaryKey . '` = :primaryKey';

    # primaryKey 추가
    $fields['primaryKey'] = $fields[$primaryKey];
    query($pdo, $sql, $fields);
}
  
function delete($pdo, $tableName, $primaryKey, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `' . $table . '`  WHERE `' . $primaryKey . '` = :id', $parameters);
}
  
function read($pdo, $tableName, $primaryKey, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM `' . $table . '`  WHERE `' . $primaryKey . '` = :id', $parameters);
    return $query->fetch();
}
  
function readAll($pdo, $tableName) {
    $query = query($pdo, 'SELECT * FROM `' . $table . '`  ORDER BY `board_id` DESC');
    return $query->fetchAll();
}
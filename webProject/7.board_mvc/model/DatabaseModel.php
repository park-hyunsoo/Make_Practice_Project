<?php
include __DIR__ . '/BaseModel.php';

class DatabaseModel extends BaseModel {
    private $table;
    private $primaryKey;
  
    public function __construct($table, $primaryKey) {
      parent::__construct();
      $this->table = $table;
      $this->primaryKey = $primaryKey;
    }

    public function query($sql, $parameters = []) {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }
    
    public function total() {
        $query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }
     
    private function insert($fields) {
        $query = 'INSERT INTO `' . $this->table . '` (';
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
    
        $this->query($query, $fields);
    }
    
    public function readAll() {
      $result = $this->query('SELECT * FROM ' . $this->table);
      return $result->fetchAll();
    }

    public function read($value) {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = ['value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }

    private function update($fields) {
        $query = ' UPDATE `' . $this->table .'` SET ';
        foreach ($fields as $key => $value) {
          $query .= '`' . $key . '` = :' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $fields[$this->primaryKey];

        $this->query($query, $fields);
    }

    public function delete($id ) {
        $parameters = [':id' => $id];
        $this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }
}
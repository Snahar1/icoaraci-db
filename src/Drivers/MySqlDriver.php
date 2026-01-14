<?php
namespace IcoaraciDB\Drivers;

use IcoaraciDB\Interface\DriverInterface;
use PDO;
use Exception;

class MySqlDriver implements DriverInterface {
    private $pdo;

    public function connect(array $config) {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (Exception $e) {
            throw new Exception("Erro de conexao IcoaraciDB: " . $e->getMessage());
        }
    }
    public function query(string $sql, array $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function insert(string $table, array $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($data));
    }
  
  public function update(string $table, array $data, array $where) {
        $setStr = "";
        foreach ($data as $key => $value) {
            $setStr .= "{$key} = ?, ";
        }
        $setStr = rtrim($setStr, ', ');

        $whereCol = array_keys($where)[0];
        $sql = "UPDATE {$table} SET {$setStr} WHERE {$whereCol} = ?";
        
        $values = array_merge(array_values($data), array_values($where));
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
  
  public function delete(string $table, array $where) {
        $whereCol = array_keys($where)[0];
        $sql = "DELETE FROM {$table} WHERE {$whereCol} = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($where));
    }
  
 public function beginTransaction() { return $this->pdo->beginTransaction(); }
 public function commit() { return $this->pdo->commit(); }
 public function rollback() { return $this->pdo->rollback(); }
}

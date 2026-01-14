<?php
namespace IcoaraciDB\Interface;

interface DriverInterface {
    public function connect(array $config);
    public function query(string $sql, array $params = []);
    public function insert(string $table, array $data);
    public function update(string $table, array $data, array $where);
    public function delete(string $table, array $where);
}

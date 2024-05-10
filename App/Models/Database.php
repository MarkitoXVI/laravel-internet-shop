<?php

namespace Models;

use PDO;

class Database
{
    public $connection;

    public function __construct($config)
    {
        $connection_string = "mysql:".http_build_query($config, '', ';');
        $this->connection = new PDO($connection_string);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function query($query_string, $params = [])
    {
        $query = $this->connection->prepare($query_string);
        $query->execute($params);
        return $query;
    }

    public function delete($table, $id)
    {
        $query = $this->connection->prepare("DELETE FROM $table WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query;
    }

    public function insert($table, $data)
    {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = array_map(function ($field) {
            return ":$field";
        }, $fields);
        $query = $this->connection->prepare("INSERT INTO $table (".implode(',', $fields).") VALUES (".implode(',', $placeholders).")");
        $query->execute(array_combine($placeholders, $values));
        return $query;
    }

    public function update($table, $id, $data)
    {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = array_map(function ($field) {
            return "$field = :$field";
        }, $fields);
        $query = $this->connection->prepare("UPDATE $table SET ".implode(',', $placeholders)." WHERE id = :id");
        $query->execute(array_combine($fields, $values) + ['id' => $id]);
        return $query;
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}
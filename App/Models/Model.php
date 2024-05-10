<?php

namespace Models;

use Core\App;

abstract class Model
{
    static $connection = null;
    static $table;
    protected array $fillable = [];

    function __construct()
    {
        static::$connection ?? static::$connection = App::resolve(Database::class);
        foreach ($this->fillable as $column) {
            $this->{$column} = '';
        }
    }

    public static function find($id): bool|Model
    {
        static::$connection ?? static::$connection = App::resolve(Database::class);
        $db = static::$connection;
        $data = $db->query("SELECT * FROM ".static::$table." WHERE id = :id", compact('id'))->fetch();

        if (!$data) { return false; }

        $model = new static;
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }
        $model->{'id'} = $id;
        return $model;
    }

    public static function where($column, $value): bool|array
    {
        static::$connection ?? static::$connection = App::resolve(Database::class);
        $db = static::$connection;
        $data = $db->query("SELECT * FROM ".static::$table." WHERE $column = :$column", [$column => $value])->fetchAll();
        if (!$data) { return false; }
        return $data;
    }

    public static function all(): bool|array
    {
        static::$connection ?? static::$connection = App::resolve(Database::class);
        $db = static::$connection;
        $data = $db->query("SELECT * FROM ".static::$table, [])->fetchAll();
        if (!$data) { return false; }
        return $data;
    }

    public function save()
    {
        $db = static::$connection;
        $data = [];
        foreach ($this->fillable as $column) {
            $data[$column] = $this->{$column};
        }
        return $db->insert(static::$table, $data);
    }

    public function delete()
    {
        $db = static::$connection;
        return $db->delete(static::$table, $this->id);
    }
}
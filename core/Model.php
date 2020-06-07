<?php

namespace Core;

use Core\Database;

abstract class Model
{
    protected $connection;
    protected $table;
    protected $attributes;

    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    public function __set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    public function __get($attribute)
    {
        return $this->attributes[$attribute];
    }

    public function __isset($attribute)
    {
        return isset($this->attributes[$attribute]);
    }

    public function save()
    {
        $columns = $this->prepare($this->attributes);
        if (!isset($this->id)) {
            $query = "INSERT INTO $table (" . implode(', ', array_keys($columns)) . ") VALUES (" . implode(', ', array_values($columns)) . ");";
        } else {
            foreach ($columns as $key => $value) {
                if ($key !== 'id') {
                    $define[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE $table SET " . implode(', ', $define) . "WHERE id='{$this->id}';";
        }
        $connection->prepare($query);
        if ($connection->execute()) {
            return $connection->rowCount();
        }
        return false;
    }

    protected function escape($data)
    {
        if (is_string($data) & !empty($data)) {
            return "'" . addslashes($data) . "'";
        } elseif (is_bool($data)) {
            return $data ? 'TRUE' : 'FALSE';
        } elseif ($data !== '') {
            return $data;
        } else {
            return 'NULL';
        }
    }

    protected function prepare($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (\is_scalar($value)) {
                $result[$key] = $this->escape($value);
            }
        }
        return $result;
    }

    public static function all()
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM $table";
        $stmt = $conn->prepare($sql);
        $result = [];
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(get_called_class())) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    public function count()
    {
        $sql = "SELECT count(*) FROM $table ;";
        $count = $this->connection->exec($sql);
        if ($count) {
            return (int) $count;
        }
        return false;
    }

    public static function find($id)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM $table WHERE id='{$id}';";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchObject(get_called_class());
                if ($result) {
                    return $result;
                }
            }
        }
        return false;
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM $table WHERE id='{$id}';";
        if ($this->connection->exec($sql)) {
            return true;
        }
        return false;
    }

}

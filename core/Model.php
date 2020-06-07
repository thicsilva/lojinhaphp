<?php

namespace Core;

use Core\Database;
use Exception;

abstract class Model
{
    protected static $connection;
    protected $table = null;
    protected $idField = null;
    protected $logTimestamp;
    protected $attributes;

    public function __construct()
    {
        self::$connection = Database::getInstance();

        if (!is_bool($this->logTimestamp)) {
            $this->logTimestamp = true;
        }
        if ($this->table == null) {
            $this->table = strtolower(explode('\\', get_called_class()));
            $this->table = end($this->table);
        }
        if ($this->idField == null) {
            $this->idField = 'id';
        }
    }

    public function __set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    public function __get($attribute)
    {
        return $this->attributes[$attribute];
    }

    public function __isset($attribute)
    {
        return isset($this->attributes[$attribute]);
    }

    public function __unset($attribute)
    {
        if (isset($attribute)) {
            unset($this->attributes[$attribute]);
            return true;
        }
        return false;
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function fromArray(array $array)
    {
        $this->attributes = $array;
    }

    public function toJson()
    {
        return json_encode($this->attributes);
    }

    public function fromJson(string $json)
    {
        $this->attributes = json_decode($json);
    }

    protected function escape($value)
    {
        if (is_string($value) & !empty($value)) {
            return "'" . addslashes($value) . "'";
        } elseif (is_bool($value)) {
            return $value ? 'TRUE' : 'FALSE';
        } elseif ($value !== '') {
            return $value;
        } else {
            return 'NULL';
        }
    }

    protected function prepare()
    {
        $result = [];
        foreach ($this->attributes as $key => $value) {
            if (is_scalar($value)) {
                $result[$key] = $this->escape($value);
            }
        }
        return $result;
    }

    public function save()
    {
        $newContent = $this->prepare();
        if (isset($this->attributes[$this->idField])) {
            $sets = [];
            foreach ($newContent as $key => $value) {
                if ($key === $this->idField || $key == 'created_at' || $key == 'updated_at') {
                    continue;
                }

                $sets[] = "{$key} = {$value}";
            }
            if ($this->logTimestamp === true) {
                $newContent['updated_at'] = "'" . date('Y-m-d H:i:s') . "'";
            }
            $sql = "UPDATE $this->table SET " . implode(', ', $newContent) . "WHERE {$this->idField}='{$this->attributes[$this->idField]}';";
        } else {
            if ($this->logTimestamp === true) {
                $newContent['created_at'] = "'" . date('Y-m-d H:i:s') . "'";
                $newContent['updated_at'] = "'" . date('Y-m-d H:i:s') . "'";
            }
            $sql = "INSERT INTO {$this->table} (" . implode(', ', array_keys($newContent)) . ') VALUES (' . implode(',', array_values($newContent)) . ');';
        }
        $stmt = self::$connection->prepare($sql);        
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return false;
    }

    public static function all(string $filter = '', int $limit = 0, int $offset = 0)
    {
        $class = get_called_class();
        $table = (new $class())->table;
        $sql = "SELECT * FROM " . (is_null($table) ? strtolower($class) : $table);
        $sql .= ($filter !== '') ? " WHERE {$filter}" : "";
        $sql .= ($limit > 0) ? " LIMIT {$limit}" : "";
        $sql .= ($offset > 0) ? " OFFSET {$offset}" : "";
        $sql .= ";";
        if (self::$connection) {
            $result = self::$connection->query($sql);
            return $result->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        } else {
            throw new Exception("Não há conexão com o banco de dados");
        }
    }

    public function count()
    {
        $sql = "SELECT count(*) FROM $this->table ;";
        $count = self::$connection->exec($sql);
        if ($count) {
            return (int) $count;
        }
        return false;
    }

    public static function find($parameter)
    {
        $class = get_called_class();
        $idField = (new $class())->idField;
        $table = (new $class())->table;

        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= ' WHERE ' . (is_null($idField) ? 'id' : $idField);
        $sql .= " = {$parameter} ;";

        if (self::$connection) {
            $result = self::$connection->query($sql);

            if ($result) {
                $newObject = $result->fetchObject(get_called_class());
            }

            return $newObject;
        } else {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public function destroy()
    {
        if (isset($this->content[$this->idField])) {

            $sql = "DELETE FROM {$this->table} WHERE {$this->idField} = {$this->content[$this->idField]};";

            if (self::$connection) {
                return self::$connection->exec($sql);
            } else {
                throw new Exception("Não há conexão com Banco de dados!");
            }
        }
    }
}

<?php

namespace App\Model;

use Core\Model;

class OrderProduct extends Model
{
    protected $logTimestamp = false;

    protected $table = 'order_product';

    public function save()
    {

        $newContent = $this->prepare();
        $sql = "INSERT INTO `$this->table` (" . implode(', ', array_keys($newContent)) . ') VALUES (' . implode(',', array_values($newContent)) . ');';
        $stmt = self::$connection->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return false;
    }
}

<?php

namespace App\Model;

use Core\Model;

class Order extends Model
{
    protected $logTimestamp = true;

    public static function totalOnPeriod(string $firstDay, string $lastDay)
    {
        $sql = "SELECT SUM(total) FROM `order` ";
        $sql .= "WHERE created_at>='$firstDay' and created_at<='$lastDay'";
        $stmt = self::$connection->prepare($sql);
        if ($stmt->execute()) {
            return doubleval($stmt->fetchColumn());
        }
        return false;
    }

}

<?php


namespace App\Queries;


use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;


class ImageQueries
{
    public static function getBy(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM image WHERE id = :id";
        return Queries::queryOne($pdo, $sql, ["id"=>$id]);
    }
}
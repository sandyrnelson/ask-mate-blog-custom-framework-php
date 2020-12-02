<?php

namespace App\Queries;

use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class TagQueries
{

    public static function getAll(PDO $pdo) : array
    {
        $sql = "SELECT *
				FROM tag";
        return Queries::queryAll($pdo, $sql);
    }


    public static function getBy(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM tag WHERE id = :id";
        return Queries::queryOne($pdo, $sql, ["id"=>$id]);
    }

    public static function addSimple(PDO $pdo, string $name) : string
    {
        $sql = "INSERT INTO tag (name)
				VALUES (:name)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["name"=>name]);
    }

    public static function getNumberOfQuestion(PDO $pdo, int $id) : int
    {
        $sql = "SELECT COUNT(id_question) as count
                FROM rel_question_tag
                WHERE id_tag = :id
                GROUP BY id_tag";
        return Queries::queryOne($pdo, $sql, ['id'=> $id])->get('count');
    }
}

<?php

namespace App\Queries;

use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class AnswerQueries
{

    public static function getAll(PDO $pdo) : array
    {
        $sql = "SELECT *
				FROM answer";
        return Queries::queryAll($pdo, $sql);
    }

    public static function getAnswersByQuestionID(PDO $pdo, $id_question) : array
    {
        $sql = "SELECT *
				FROM answer WHERE id_question = :id_question";
        return Queries::queryAll($pdo, $sql, ['id_question' => $id_question]);
    }



    public static function getBy(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM answer WHERE id = :id";
        return Queries::queryOne($pdo, $sql, ["id"=>$id]);
    }

    public static function addSimple(PDO $pdo, string $message) : string
    {
        $sql = "INSERT INTO answer (message)
				VALUES (:message)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["message"=>$message]);
    }
}
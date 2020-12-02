<?php

namespace App\Queries;

use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class RelQuestionTagQueries
{




    public static function getBy(PDO $pdo, int $id_question) : ResultSet
    {
        $sql = "SELECT *
				FROM rel_question_tag WHERE id_question = :id";
        return Queries::queryOne($pdo, $sql, ["id_question"=> $id_question]);
    }

    public static function addSimple(PDO $pdo, int $id_question, int $id_tag) : string
    {
        $sql = "INSERT INTO rel_question_tag (id_question, id_tag)
				VALUES (:name)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question"=>$id_question, "id_tag"=> $id_tag]);
    }
}

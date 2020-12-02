<?php

namespace App\Queries;

use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class RelQuestionTagQueries
{


    public static function getBy(PDO $pdo, int $id_question) : array
    {
        $sql = "SELECT tag.name FROM rel_question_tag
                    join tag
                    on rel_question_tag.id_tag = tag.id
                    WHERE id_question = :id_question";
        return Queries::queryAll($pdo, $sql, ["id_question"=> $id_question]);
    }



    public static function addSimple(PDO $pdo, int $id_question, int $id_tag) : string
    {
        $sql = "INSERT INTO rel_question_tag (id_question, id_tag)
				VALUES (:name)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question"=>$id_question, "id_tag"=> $id_tag]);
    }
}

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



    public static function getTagRelationsByTagId(PDO $pdo, string $tagId): array
    {
        $sql = "SELECT id, id_question 
                FROM rel_question_tag WHERE id_tag = :tagId";
        return Queries::queryAll($pdo, $sql, ['tagId' => $tagId]);
    }

    public static function addSimple(PDO $pdo, int $id_question, int $id_tag) : string
    {
        $sql = "INSERT INTO rel_question_tag (id_question, id_tag)
				VALUES (:id_question, :id_tag)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question"=>$id_question, "id_tag"=> $id_tag]);
    }

    public static function deleteTagQuestionRelation(PDO $pdo, string $relationId): string
    {
        $sql = "DELETE FROM rel_question_tag WHERE id = :id";

        return Queries::executeAndReturnWithId($pdo, $sql, ["id" => $relationId]);
    }

    public static function deleteWithQuestion(PDO $pdo, string $questionId): string
    {
        $sql = "DELETE FROM rel_question_tag
                WHERE id_question = :id_question";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question" => $questionId]);
    }
}

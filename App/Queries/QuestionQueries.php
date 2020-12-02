<?php

namespace App\Queries;

use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class QuestionQueries
{

    public static function getAll(PDO $pdo) : array
    {
        $sql = "SELECT *
				FROM question";
        return Queries::queryAll($pdo, $sql);
    }



    public static function getBy(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM question WHERE id = :id";
        return Queries::queryOne($pdo, $sql, ["id"=>$id]);
    }

    public static function addSimple(PDO $pdo, string $message) : string
    {
        $sql = "INSERT INTO question (message)
				VALUES (:message)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["message"=>$message]);
    }

    public static function addQuestion(PDO $pdo, string $userId, string $title, string $message, string $imageName = null) : string
    {
        $voteCount = 0;
        if ($imageName === null) {
            $imageId = 1;
            }
        else {
            //TODO add image to image db and get id from there
            $imageId = 1;
        }
        $sql = "INSERT INTO question (id_registered_user, title, message, vote_number, id_image)
				VALUES (:userId, :title, :message, :vote_number, :id_image)";


        return Queries::executeAndReturnWithId($pdo, $sql, ["userId"=>$userId, "title"=>$title, "message"=>$message, "vote_number"=>$voteCount, "id_image"=>$imageId]);
    }

    public static function updateQuestion(PDO $pdo, int $id, string $title, string $message) : string
    {
        $sql = "UPDATE question
                SET title=:title, message=:message
                WHERE id=:id ";
        Queries::executeAndReturnWithId($pdo, $sql, ["id"=>$id, "title"=>$title, "message"=>$message]);
        return $id;
    }

    public static function delete(PDO $pdo, string $id) : string
    {
        $sql = "DELETE FROM question
                WHERE id = :id";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id"=>$id]);
    }
}
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
        $sql = "SELECT answer.id, answer.id_question,
                    answer.id_registered_user, registered_user.email as answerOwner,
                    answer.message, answer.vote_number,answer.submission_time
                FROM answer
                JOIN registered_user on answer.id_registered_user = registered_user.id
                WHERE id_question= :id_question";
        return Queries::queryAll($pdo, $sql, ['id_question' => $id_question]);
    }

    public static function getBy(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM answer WHERE id = :id";
        return Queries::queryOne($pdo, $sql, ["id"=>$id]);
    }

    public static function getAnswersByUserID(PDO $pdo, $userId) : array
    {
        $sql = "SELECT answer.id, q.title as title, q.message as question,
                    answer.message as answer, answer.vote_number, answer.submission_time
                FROM answer
                JOIN registered_user ru on ru.id = answer.id_registered_user
                JOIN question q on q.id = answer.id_question
                WHERE answer.id_registered_user= :id_regisetered_user";
        return Queries::queryAll($pdo, $sql, ['id_regisetered_user' => $userId]);
    }

    public static function addSimple(PDO $pdo, string $message) : string
    {
        $sql = "INSERT INTO answer (message)
				VALUES (:message)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["message"=>$message]);
    }

    public static function addAnswer(PDO $pdo, string $questionId, string $userId, string $message) : string
    {
        $voteCount = 0;
        $sql = "INSERT INTO answer (id_question, id_registered_user, message, vote_number)
				VALUES (:id_question, :userId, :message, :vote_number)";

        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question"=>$questionId, "userId"=>$userId, "message"=>$message, "vote_number"=>$voteCount]);
    }

    public static function deleteWithQuestion(PDO $pdo, string $questionId) : string
    {
        $sql = "DELETE FROM answer
                WHERE id_question = :id_question";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id_question"=>$questionId]);
    }

    public static function updateAnswer(PDO $pdo, string $id, string $message)
    {
        $sql = "UPDATE answer
                SET message=:message
                WHERE id=:id ";
        Queries::executeAndReturnWithId($pdo, $sql, ["id"=>$id, "message"=>$message]);
        return $id;
    }

    public static function delete(PDO $pdo, string $id) : string
    {
        $sql = "DELETE FROM answer
                WHERE id = :id";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id"=>$id]);
    }

    public static function updateVote(PDO $pdo, string $id, int $voteCount) : string
    {
        $sql = "UPDATE answer
                SET vote_number=:voteCount
                WHERE id=:id";
        return Queries::executeAndReturnWithId($pdo, $sql, ["id"=>$id, "voteCount"=>$voteCount]);
    }

    public static function search(PDO $pdo, $questionId, string $searchText)
    {
        $sql = "SELECT message FROM answer
                WHERE id_question = :id_question AND 
                     message like :search_word";
        return Queries::queryAll($pdo, $sql, ["id_question"=>$questionId,"search_word"=> "%".$searchText."%"]);
    }


}

<?php


namespace App\Queries;


use BK_Framework\Database\QueryTools\Queries;
use BK_Framework\Database\QueryTools\ResultSet;
use PDO;

class UserQueries
{

    public static function getAllUsers(PDO $pdo) : array
    {
        $sql = "SELECT *
				FROM registered_user";
        return Queries::queryAll($pdo, $sql);
    }

    public static function getUsersWithDetails(PDO $pdo): array
    {
        $sql = "SELECT  registered_user.id,  registered_user.email, registered_user.registration_time,
                    COUNT( distinct question.id) as numberOfQuestions, COUNT( answer.id) as numberOfAnswers
                FROM registered_user
                JOIN answer ON registered_user.id = answer.id_registered_user
                JOIN question ON answer.id_question = question.id
                GROUP BY registered_user.id;";
        return Queries::queryAll($pdo, $sql);
    }

    public static function getById(PDO $pdo, int $id) : ResultSet
    {
        $sql = "SELECT *
				FROM registered_user
				WHERE id= :id";
        return Queries::queryOne($pdo, $sql, ['id' => $id]);
    }

    public static function getUserIDBySessionName(PDO $pdo, string $name) : ResultSet
    {
        $sql = "SELECT id
				FROM registered_user
				WHERE email= :email";
        return Queries::queryOne($pdo, $sql, ['email' => $name]);
    }

    public static function addUser(PDO $pdo, string $email, string $hashedPassword) : string
    {
        $sql = "INSERT INTO registered_user (email, password_hash)
				VALUES (:email, :password_hash)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["email"=>$email, "password_hash"=>$hashedPassword]);
    }
}
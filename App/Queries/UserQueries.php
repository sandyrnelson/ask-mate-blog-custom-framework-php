<?php


namespace App\Queries;


use BK_Framework\Database\QueryTools\Queries;
use PDO;

class UserQueries
{

    public static function getAllUsers(PDO $pdo) : array
    {
        $sql = "SELECT id, email, password_hash, registration_time
				FROM registered_user";
        return Queries::queryAll($pdo, $sql);
    }



    public static function addUser(PDO $pdo, string $email, string $hashedPassword) : string
    {
        $sql = "INSERT INTO registered_user (email, password_hash)
				VALUES (:email, :password_hash)";
        return Queries::executeAndReturnWithId($pdo, $sql, ["email"=>$email, "password_hash"=>$hashedPassword]);
    }
}
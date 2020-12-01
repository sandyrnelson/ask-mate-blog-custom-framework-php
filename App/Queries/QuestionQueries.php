<?php


namespace App\Queries;


use BK_Framework\Database\QueryTools\Queries;
use PDO;

class QuestionQueries
{
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


        return Queries::executeAndReturnWithId($pdo, $sql, ["userId"=>$userId,
                                                            "title"=>$title,
                                                            "message"=>$message,
                                                            "vote_number"=>$voteCount,
                                                            "id_image"=>$imageId]);
    }
}
<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;
use BK_Framework\SuperGlobal\Post;

class DeleteQuestionController extends BaseController
{
    private int $questionId;

    public function __construct($id)
    {
        parent::__construct();
        $this -> questionId = $id;
    }

    public function getQuestionID(): int
    {
        return $this->questionId;
    }

    public function run() {
        session_start();
        $id = $this ->getQuestionID();
        $connection = $this->getConnection();
        TagQueries::deleteWithQuestion($connection, $id);
        AnswerQueries::deleteWithQuestion($connection, $id);
        QuestionQueries::delete($connection, $id);

    }

}
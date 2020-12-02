<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;

class DeleteAnswerController extends BaseController
{
    private int $answerId;

    public function __construct($answerId)
    {
        parent::__construct();
        $this -> answerId = $answerId;
    }


    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    public function run() {
        session_start();
        $id = $this ->getAnswerId();
        $connection = $this->getConnection();
        return AnswerQueries::delete($connection, $id);
    }
}
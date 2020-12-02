<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;

class AnswerVoteController extends BaseController
{
    private int $answerId;
    private int $voteCountChange;



    public function __construct($id, $voteDirection)
    {
        parent::__construct();
        $this -> answerId = $id;
        if ($voteDirection === "up"){
            $this->voteCountChange = 1;
        }else {
            $this->voteCountChange = -1;
        }
    }


    public function getAnswerId(): int
    {
        return $this->answerId;
    }


    public function getVoteCountChange(): int
    {
        return $this->voteCountChange;
    }

    public function run() {
        session_start();
        $answerId = $this->getAnswerId();
        $connection = $this->getConnection();
        $answerDetails = AnswerQueries::getBy($connection, $answerId) -> getRecord();
        $answerVoteCount = (int)($answerDetails ['vote_number']) + $this->getVoteCountChange();
        return AnswerQueries::updateVote($connection, $answerId, $answerVoteCount);

    }
}
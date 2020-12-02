<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;

class VoteController extends BaseController
{

    private int $questionId;
    private int $voteCountChange;



    public function __construct($id, $voteDirection)
    {
        parent::__construct();
        $this -> questionId = $id;
        if ($voteDirection === "up"){
            $this->voteCountChange = 1;
        }else {
            $this->voteCountChange = -1;
        }
    }

    public function getQuestionID(): int
    {
        return $this->questionId;
    }


    public function getVoteCountChange(): int
    {
        return $this->voteCountChange;
    }

    public function run() {
        session_start();
        $questionId = $this->getQuestionID();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $questionId) -> getRecord();
        $questionVoteCount = (int)($questionDetails['vote_number']) + $this->getVoteCountChange();
        QuestionQueries::updateVote($connection, $questionId,$questionVoteCount);

        header("Location: /question/".$questionId );
    }

}
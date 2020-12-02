<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;

/**
 * Class AnswerVoteController
 * @package App\Controller
 */
class AnswerVoteController extends BaseController
{
    /**
     * @var int
     */
    private int $answerId;
    /**
     * @var int
     */
    private int $voteCountChange;


    /**
     * AnswerVoteController constructor.
     * @param $id
     * @param $voteDirection
     */
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


    /**
     * @return int
     */
    public function getAnswerId(): int
    {
        return $this->answerId;
    }


    /**
     * @return int
     */
    public function getVoteCountChange(): int
    {
        return $this->voteCountChange;
    }

    /**
     * @return string
     */
    public function run() {
        session_start();
        $answerId = $this->getAnswerId();
        $connection = $this->getConnection();
        $answerDetails = AnswerQueries::getBy($connection, $answerId) -> getRecord();
        $answerVoteCount = (int)($answerDetails ['vote_number']) + $this->getVoteCountChange();
        return AnswerQueries::updateVote($connection, $answerId, $answerVoteCount);

    }
}
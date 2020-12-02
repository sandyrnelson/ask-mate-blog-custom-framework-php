<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;

/**
 * Class VoteController
 * @package App\Controller
 */
class VoteController extends BaseController
{

    /**
     * @var int
     */
    private int $questionId;
    /**
     * @var int
     */
    private int $voteCountChange;


    /**
     * VoteController constructor.
     * @param $id
     * @param $voteDirection
     */
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

    /**
     * @return int
     */
    public function getQuestionID(): int
    {
        return $this->questionId;
    }


    /**
     * @return int
     */
    public function getVoteCountChange(): int
    {
        return $this->voteCountChange;
    }

    /**
     *
     */
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
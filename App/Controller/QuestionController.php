<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;
use App\Queries\UserQueries;

/**
 * Class QuestionController
 * @package App\Controller
 */
class QuestionController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;

    /**
     * QuestionController constructor.
     * @param $id
     */
    public function __construct($id)
    {
        parent::__construct();
        $this -> questionId = $id;
    }

    /**
     * @return int
     */
    public function getQuestionID(): int
    {
        return $this->questionId;
    }

    /**
     *
     */
    public function run() {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();

        $userName = UserQueries::getUsernameById($connection, $questionDetails['id_registered_user'])->getRecord();

        $answersByQuestionID = AnswerQueries::getAnswersByQuestionID($connection, $this->getQuestionID());
        $answers = $this -> getArraysOfRecords($answersByQuestionID);
        $tagsRecords = RelQuestionTagQueries::getBy($connection, $questionDetails['id']);
        $tags = $this -> getArraysOfRecords($tagsRecords);

        $this->view("question", ['question' => $questionDetails, 'answers' => $answers, 'tags' => $tags, 'questionOwner' => $userName]);
    }


}
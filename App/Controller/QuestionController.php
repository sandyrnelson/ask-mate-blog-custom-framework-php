<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;
use App\Queries\UserQueries;

class QuestionController extends BaseController
{
    private int $questionId;

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

    public function getArraysOfRecords(array $records): array
    {
        $result = array();
        foreach ($records as $record) {
            array_push($result, $record->getRecord());
        }
        return  $result;
    }
}
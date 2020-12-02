<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;

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
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();
        $answersByQuestionID = AnswerQueries::getAnswersByQuestionID($connection, $this->getQuestionID());
        $answers = $this -> getArraysOfRecords($answersByQuestionID);
        $tagsRecords = TagQueries::getAll($connection);
        $tags = $this -> getArraysOfRecords($tagsRecords);

        $session = ["user" => 'Virag', 'id' => 4444];

        $this->view("question", ['question' => $questionDetails, 'answers' => $answers, 'session' => $session, 'tags' => $tags]);
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
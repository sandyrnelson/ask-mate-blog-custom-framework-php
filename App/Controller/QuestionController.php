<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;

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
        $answers = array();
        foreach ($answersByQuestionID as $answer) {
            array_push($answers, $answer->getRecord());
        }
        $session = ["user" => 'Virag', 'id' => 4444];
        $this->view("question", ['question' => $questionDetails, 'answers' => $answers, 'session' => $session]);
    }
}
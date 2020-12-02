<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;

class EditAnswerController extends BaseController
{
    private int $questionId;
    private int $answerId;

    public function __construct($id, $answerId)
    {
        parent::__construct();
        $this -> questionId = $id;
        $this -> answerId = $answerId;
    }

    public function getQuestionID(): int
    {
        return $this->questionId;
    }

    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    public function run() {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();
        $answerDetails = AnswerQueries::getBy($connection, $this->getAnswerId()) ->getRecord();

        $this->view("addAnswerForm", ['question' => $questionDetails, 'answer' => $answerDetails]);
    }

    public function updateAnswer(){
        $connection = $this->getConnection();
        $message = Post::get("message");
        AnswerQueries::updateAnswer($connection, $this->getAnswerId(), $message);
        return $this->getQuestionID();

    }
}
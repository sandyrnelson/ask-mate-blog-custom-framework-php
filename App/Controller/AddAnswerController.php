<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;
use BK_Framework\SuperGlobal\Session;

class AddAnswerController extends BaseController
{
    private int $questionId;

    public function __construct($id)
    {
        parent::__construct();
        $this -> questionId = $id;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();
        $this->view("addAnswerForm", ['question' => $questionDetails]);
    }


    public function addAnswer(){
        session_start();
        $connection = $this->getConnection();
        $questionId = $this->getQuestionId();
        $message = Post::get("message");
        $userId = Session::get("userId");
        AnswerQueries::addAnswer($connection, $questionId, $userId, $message );
        return $questionId;

    }

}
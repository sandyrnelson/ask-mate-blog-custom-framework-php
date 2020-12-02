<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;
use BK_Framework\SuperGlobal\Post;

class EditQuestionController extends BaseController
{
    private int $questionId;

    public function __construct($id)
    {
        parent::__construct();
        $this -> questionId = $id;
    }

    public function getQuestionID(): int
    {
        return $this->questionId;
    }

    public function run() {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();

        $this->view("questionEditForm", ['question' => $questionDetails]);
    }

    public function updateQuestion(){
        $connection = $this->getConnection();
        $message = Post::get("message");
        $title = Post::get("title");
        return QuestionQueries::updateQuestion($connection, $this->getQuestionID(), $title, $message);

    }
}
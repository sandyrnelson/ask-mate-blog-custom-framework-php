<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;
use BK_Framework\SuperGlobal\Post;

/**
 * Class EditQuestionController
 * @package App\Controller
 */
class EditQuestionController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;

    /**
     * EditQuestionController constructor.
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

        $this->view("questionEditForm", ['question' => $questionDetails]);
    }

    /**
     * @return string
     */
    public function updateQuestion(): string
    {
        $connection = $this->getConnection();
        $message = Post::get("message");
        $title = Post::get("title");
        return QuestionQueries::updateQuestion($connection, $this->getQuestionID(), $title, $message);

    }
}
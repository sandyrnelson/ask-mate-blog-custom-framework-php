<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;

/**
 * Class EditAnswerController
 * @package App\Controller
 */
class EditAnswerController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;
    /**
     * @var int
     */
    private int $answerId;

    /**
     * EditAnswerController constructor.
     * @param $id
     * @param $answerId
     */
    public function __construct($id, $answerId)
    {
        parent::__construct();
        $this -> questionId = $id;
        $this -> answerId = $answerId;
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
    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    /**
     *
     */
    public function run() {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();
        $answerDetails = AnswerQueries::getBy($connection, $this->getAnswerId()) ->getRecord();

        $this->view("addAnswerForm", ['question' => $questionDetails, 'answer' => $answerDetails]);
    }

    /**
     * @return int
     */
    public function updateAnswer(): int
    {
        $connection = $this->getConnection();
        $message = Post::get("message");
        AnswerQueries::updateAnswer($connection, $this->getAnswerId(), $message);
        return $this->getQuestionID();

    }
}
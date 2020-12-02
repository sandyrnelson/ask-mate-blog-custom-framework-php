<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use BK_Framework\Exception\NoSessionException;
use BK_Framework\SuperGlobal\Post;
use BK_Framework\SuperGlobal\Session;

/**
 * Class AddAnswerController
 * @package App\Controller
 */
class AddAnswerController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;

    /**
     * AddAnswerController constructor.
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
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     *
     */
    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();
        $this->view("addAnswerForm", ['question' => $questionDetails]);
    }


    /**
     * @return int
     * @throws NoSessionException
     */
    public function addAnswer(): int
    {
        session_start();
        $connection = $this->getConnection();
        $questionId = $this->getQuestionId();
        $message = Post::get("message");
        $userId = Session::get("userId");
        AnswerQueries::addAnswer($connection, $questionId, $userId, $message );
        return $questionId;

    }

}
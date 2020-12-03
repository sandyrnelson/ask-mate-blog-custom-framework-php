<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\UserQueries;

/**
 * Class UsersController
 * @package App\Controller
 */
class UserPageController extends BaseController
{
    public int $userId;

    public function __construct($userId)
    {
        parent::__construct();
        $this->userId = $userId;
    }


    public function run()
    {
        session_start();
        $connection = $this->getConnection();

        $loggedUser = $this->getLoggedUserId() ? UserQueries::getUserIDBySessionName($connection, $_SESSION['userName']) -> getRecord() : 0;

        $user = UserQueries::getById($connection, $this->userId)->getRecord();

        $answersFromDB = AnswerQueries::getAnswersByUserID($connection, $this->userId);

        $answers = $this->getArraysOfRecords($answersFromDB);

        $questionsFromDB = QuestionQueries::getQuestionsByUserID($connection, $this->userId);
        $questions = $this->getArraysOfRecords($questionsFromDB);

        $this->view("userpage", ['user' => $user, 'answers' => $answers, 'questions' => $questions, 'loggedUser' => $loggedUser]);

    }
}
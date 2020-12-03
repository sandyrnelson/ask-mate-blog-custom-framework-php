<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use App\Queries\UserQueries;

/**
 * Class MainPageController
 * @package App\Controller
 */
class MainPageController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        session_start();

        $connection = $this->getConnection();
        $loggedUser = $this->getLoggedUserId() ? UserQueries::getUserIDBySessionName($connection, $_SESSION['userName']) -> getRecord() : 0;

        $questionsFromDB = QuestionQueries::getAll($connection);
        $questions = $this->getArraysOfRecords($questionsFromDB);
        $sortedQuestions = $this->sortByColumn($questions, 'submission_time');
        $this->view("mainPage", ["questions" => $sortedQuestions, 'loggedUser'=> $loggedUser]);
    }
}
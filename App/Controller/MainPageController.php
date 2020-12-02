<?php


namespace App\Controller;


use App\Queries\QuestionQueries;

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
        $questionsFromDB = QuestionQueries::getAll($connection);
        $questions = $this->getArraysOfRecords($questionsFromDB);
        $sortedQuestions = $this->sortByColumn($questions, 'submission_time');

        $this->view("mainPage", ["questions" => $sortedQuestions]);
    }
}
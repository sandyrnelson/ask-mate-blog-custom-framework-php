<?php


namespace App\Controller;


use App\Queries\QuestionQueries;

class MainPageController extends BaseController
{

    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $questionsFromDB = QuestionQueries::getAll($connection);
        $questions = array();
        foreach ($questionsFromDB as $question) {
            $record['id'] = $question -> get('id');
            $record['title'] = $question -> get('title');
            $record['message'] = $question -> get('message');
            $record['submission_time'] = $question -> get('submission_time');
            $record['id_registered_user'] = $question -> get('id_registered_user');
            array_push($questions, $record);
        }
        $array_column = array_column($questions, 'submission_time');
        array_multisort($array_column, SORT_DESC, $questions);
        $this->view("mainPage", ["questions" => $questions]);
    }
}
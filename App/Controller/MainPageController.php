<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use App\Queries\BandQueries;

class MainPageController extends BaseController
{

    public function run()
    {
        $connection = $this->getConnection();
        $questionsFromDB = QuestionQueries::getAll($connection);
        $questions = array();
        foreach ($questionsFromDB as $question) {
            $record['id'] = $question -> get('id');
            $record['title'] = $question -> get('title');
            $record['message'] = $question -> get('message');
            $record['submission_time'] = $question -> get('submission_time');
            array_push($questions, $record);
        }
        $array_column = array_column($questions, 'submission_time');
        array_multisort($array_column, SORT_DESC, $questions);
        $this->view("mainpage", ["questions" => $questions]);
    }
}
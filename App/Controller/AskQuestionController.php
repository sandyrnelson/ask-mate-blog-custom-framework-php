<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Session;

class AskQuestionController extends BaseController
{

    public function run()
    {
        $this->view("askQuestionForm", []);
    }

    private function getBody()
    {
        $body = array();

        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        //TODO Fix session updating accorind to Szobas settings when login is completed
        if (isset( $_SESSION["userId"]))
        {
            $body["userId"] = $_SESSION["userId"];
        }
        else
        {
            $body["userId"] = 1;
        }


        return $body;
    }

    public function addQuestion(){
        $body = $this->getBody();
        if (array_key_exists('imageName', $body)) {
            QuestionQueries::addQuestion($this->getConnection(), $body['userId'], $body['title'], $body['message'], $body['imageName'] );
        }
        QuestionQueries::addQuestion($this->getConnection(), $body['userId'], $body['title'], $body['message'] );
        return "added";
    }
}
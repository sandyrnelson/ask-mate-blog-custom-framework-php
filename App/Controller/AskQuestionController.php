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

    /**
     * @return array
     * @throws \BK_Framework\Exception\NoSessionException
     */
    private function getBody()
    {

        $body = array();

        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (Session::has('userId'))
        {
            $body["userId"] = Session::get('userId');
        }


        return $body;
    }

    public function addQuestion(){
        $connection = $this->getConnection();
        $body = $this->getBody();
        if (array_key_exists('imageName', $body)) {
            QuestionQueries::addQuestion($connection, $body['userId'], $body['title'], $body['message'], $body['imageName'] );
        }
        return QuestionQueries::addQuestion($connection, $body['userId'], $body['title'], $body['message'] );

    }
}
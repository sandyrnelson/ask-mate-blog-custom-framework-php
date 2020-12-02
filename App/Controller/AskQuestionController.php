<?php


namespace App\Controller;


use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Files;
use BK_Framework\SuperGlobal\Session;

/**
 * Class AskQuestionController
 * @package App\Controller
 */
class AskQuestionController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        session_start();
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

    /**
     * @return string
     * @throws \BK_Framework\Exception\NoSessionException
     */
    public function addQuestion(): string
    {
        session_start(); //TODO not necessary
        $connection = $this->getConnection();

        $body = $this->getBody();
        $imageData = Files::saveImage();
        if (0 < count($imageData)) {
            $imageId = QuestionQueries::saveImageData($connection, $imageData['directory'], $imageData['fileName']);
            $body['imageId'] = $imageId;
        }
        if (array_key_exists('imageName', $body)) {
            QuestionQueries::addQuestion($connection, $body['userId'], $body['title'], $body['message'], $body['imageId'] );
        }
        return QuestionQueries::addQuestion($connection, $body['userId'], $body['title'], $body['message'] );

    }


}
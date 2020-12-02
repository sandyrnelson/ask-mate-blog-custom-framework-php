<?php


namespace App\Routes;


use App\Controller\AskQuestionController;
use App\Controller\MainPageController;
use App\Queries\QuestionQueries;
use BK_Framework\Router\Router;

class AskQuestionRoutes
{
    public static function init()
    {

        Router::add("/ask-question", function () {
            $controller = new AskQuestionController();
            $controller->run();
        }, "GET");

        Router::add("/ask-question", function () {
            session_start();
            $controller = new AskQuestionController();
            $questionId = $controller->addQuestion();
//            header("Location: " . '/');
//            $test = $_GET['/question/' . $questionId];
//            header('Location: '.$test);
            $controller = new QuestionController($questionId);
            $controller -> run();
            exit();

        }, "POST");
    }
}
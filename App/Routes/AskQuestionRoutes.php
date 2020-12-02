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
            echo "posted";
            $controller = new AskQuestionController();
            $questionId = $controller->addQuestion();
//            header("Location: " . '/');

            header("Location: /question/".$questionId );
            exit();

        }, "POST");
    }
}
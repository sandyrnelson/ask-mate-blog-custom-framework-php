<?php


namespace App\Routes;


use App\Controller\AddAnswerController;
use App\Controller\AskQuestionController;
use BK_Framework\Router\Router;

class AnswerRoutes
{
    public static function init()
    {

        Router::add("/question/([0-9]*)/add-answer", function ($param) {
            $controller = new AddAnswerController($param);
            $controller->run();
        }, "GET");

        Router::add("/question/([0-9]*)/add-answer", function ($param) {
            session_start();
            $controller = new AddAnswerController($param);
            $questionId = $controller->addAnswer();
            header("Location: /question/".$questionId );
            exit();

        }, "POST");
    }

}
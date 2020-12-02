<?php


namespace App\Routes;


use App\Controller\AddAnswerController;
use App\Controller\AskQuestionController;
use App\Controller\EditAnswerController;
use App\Controller\EditQuestionController;
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

        Router::add('/question/([0-9]*)/edit-answer/([0-9]*)', function ($paramOne, $paramTwo) {
            $controller = new EditAnswerController($paramOne, $paramTwo);
            $controller -> run();
        }, "GET");

        Router::add('/question/([0-9]*)/edit-answer/([0-9]*)', function ($paramOne, $paramTwo) {
            $controller = new EditAnswerController($paramOne, $paramTwo);
            $id = $controller -> updateAnswer();
            header("Location: /question/$id" );
        }, "POST");
    }

}
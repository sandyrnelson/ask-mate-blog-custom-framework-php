<?php


namespace App\Routes;


use App\Controller\EditQuestionController;
use App\Controller\QuestionController;
use BK_Framework\Router\Router;

class GetRoutes
{
	public static function init()

	{
	    Router::add('/question/([0-9]*)', function ($param) {
            $controller = new QuestionController($param);
            $controller -> run();
        }, "GET");


		Router::add("/get/([0-9]*)", function ($param) {
			echo "Got number $param";
		}, "GET");

		Router::add("/get/([^0-9]*)", function ($param) {
			echo "Got string $param";
		}, "GET");

		Router::add("/get/(.*)", function ($param) {
			echo "Got mixed $param";
		}, "GET");

		Router::add("/get/(.*)/(.*)", function ($paramOne, $paramTwo) {
			echo "Got params $paramOne and $paramTwo";
		}, "GET");

        Router::add('/question/([0-9]*)/edit', function ($param) {
            $controller = new EditQuestionController($param);
            $controller -> run();
        }, "GET");

        Router::add('/question/([0-9]*)/edit', function ($param) {
            $controller = new EditQuestionController($param);
            $id = $controller -> updateQuestion();
            header("Location: /question/$id" );
        }, "POST");

	}
}

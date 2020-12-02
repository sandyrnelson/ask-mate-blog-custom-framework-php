<?php


namespace App\Routes;


use App\Controller\MainPageController;
use App\Controller\QuestionController;
use App\Controller\TagController;
use App\Controller\SessionController;
use App\Controller\TagDeleteController;
use App\Controller\UsersController;
use BK_Framework\Router\Router;

class OtherRoutes
{

	public static function init()
	{

		Router::add("/", function () {
		    $controller = new MainPageController();
		    $controller->run();
		}, "GET");

		Router::add("/tags", function () {
			$controller = new TagController();
			$controller->run();
		}, "GET");

        Router::add('/delete_tag/([0-9]*)/([^0-9]*)', function ($paramOne, $paramTwo) {
            $controller = new TagDeleteController($paramOne, $paramTwo);
            $controller -> run();
        }, "GET");

		Router::add("/users", function () {
			$controller = new UsersController();
			$controller->run();
		}, "GET");



	}

}

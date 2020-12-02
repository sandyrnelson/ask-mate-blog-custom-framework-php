<?php


namespace App\Routes;


use App\Controller\MainPageController;
use App\Controller\SessionController;
use BK_Framework\Router\Router;

class OtherRoutes
{

	public static function init()
	{

		Router::add("/", function () {
		    $controller = new MainPageController();
		    $controller->run();
		}, "GET");


		Router::add("/session", function () {
			$controller = new SessionController();
			$controller->run();
		}, "GET");
//
//		Router::add("/names", function () {
//			echo "Name";
//		}, "POST");

	}

}

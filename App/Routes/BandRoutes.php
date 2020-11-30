<?php


namespace App\Routes;


use App\Controller\InsertController;
use App\Controller\ListController;
use App\Controller\SearchController;
use BK_Framework\Router\Router;

class BandRoutes
{

	public static function init()
	{

		Router::add("/list", function () {
			$controller = new ListController();
			$controller->run();
		}, "GET");

		Router::add("/search/([0-9]*)", function ($id) {
			$controller = new SearchController($id);
			$controller->run();
		}, "GET");

		Router::add("/insert-band/(.*)", function ($name) {
			$controller = new InsertController($name);
			$controller->run();
		}, "GET");

	}

}

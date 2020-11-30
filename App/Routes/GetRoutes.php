<?php


namespace App\Routes;


use BK_Framework\Router\Router;

class GetRoutes
{
	public static function init()
	{

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

	}
}

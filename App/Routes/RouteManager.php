<?php


namespace App\Routes;


class RouteManager
{

	public static function init()
	{
		BandRoutes::init();
		GetRoutes::init();
		OtherRoutes::init();

	}

}

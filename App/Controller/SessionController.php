<?php


namespace App\Controller;


use BK_Framework\Exception\NoSessionException;
use BK_Framework\SuperGlobal\Session;

class SessionController extends BaseController
{

	public function run()
	{
		try {
			session_start();
			Session::logout();
			Session::unset("color");
			echo Session::get("color");
			echo Session::get("name");
		} catch (NoSessionException $exception) {
			echo "Something went wrong, could not retrieve data";
		}

	}
}

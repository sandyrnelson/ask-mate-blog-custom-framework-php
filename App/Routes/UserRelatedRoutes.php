<?php


namespace App\Routes;


use App\Controller\RegistrationController;
use BK_Framework\Router\Router;

class UserRelatedRoutes
{
    public static function init()
    {
        Router::add("/registration", function () {
            $controller = new RegistrationController();
            $controller->run();
        }, "GET");
    }
}
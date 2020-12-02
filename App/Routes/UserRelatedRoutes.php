<?php


namespace App\Routes;


use App\Controller\LoginController;
use App\Controller\LoginHandlerController;
use App\Controller\RegistrationController;
use App\Controller\RegistrationHandlerController;
use BK_Framework\Router\Router;

class UserRelatedRoutes
{
    public static function init()
    {
        Router::add("/registration", function () {
            $controller = new RegistrationController();
            $controller->run();
        }, "GET");

        Router::add("/registration", function () {
            $controller = new RegistrationHandlerController();
            $controller->run();
        }, "POST");

        Router::add("/login", function () {
            $controller = new LoginController();
            $controller->run();
        }, "GET");

        Router::add("/login", function () {
            $controller = new LoginHandlerController();
            $controller->run();
        }, "POST");

        Router::add("/logout", function () {
            $controller = new RegistrationController();
            $controller->run();
        }, "GET");

    }
}
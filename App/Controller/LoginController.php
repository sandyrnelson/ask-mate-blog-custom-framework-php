<?php


namespace App\Controller;


class LoginController extends BaseController
{

    public function run()
    {
        $this->view("loginPage", []);
    }
}
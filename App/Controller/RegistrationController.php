<?php


namespace App\Controller;


class RegistrationController extends BaseController
{

    public function run()
    {
        $this->view("registrationPage", []);
    }
}
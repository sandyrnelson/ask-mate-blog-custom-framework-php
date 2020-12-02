<?php


namespace App\Controller;


/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        $this->view("registrationPage", []);
    }
}
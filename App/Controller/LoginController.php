<?php


namespace App\Controller;


/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        $this->view("loginPage", []);
    }
}
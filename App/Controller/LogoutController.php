<?php


namespace App\Controller;


use BK_Framework\Exception\NoSessionException;
use BK_Framework\SuperGlobal\Session;

/**
 * Class LogoutController
 * @package App\Controller
 */
class LogoutController extends BaseController
{

    /**
     * @throws NoSessionException
     */
    public function run()
    {
        session_start();
        Session::logout();

        header("Location: " . '/');
        exit();
    }
}
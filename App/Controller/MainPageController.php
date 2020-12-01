<?php


namespace App\Controller;


class MainPageController extends BaseController
{

    public function run()
    {
        $this->view("mainPage", []);
    }
}
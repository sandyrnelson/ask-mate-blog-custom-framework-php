<?php


namespace App\Controller;


use BK_Framework\SuperGlobal\Get;

class GetPostController extends BaseController
{

    public function run()
    {
        foreach (Get::keySet() as $key) echo $key;
    }
}

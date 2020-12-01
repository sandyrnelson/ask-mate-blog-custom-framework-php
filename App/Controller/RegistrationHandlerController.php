<?php


namespace App\Controller;


use App\Queries\UserQueries;
use BK_Framework\SuperGlobal\Post;

class RegistrationHandlerController extends BaseController
{

    public function run()
    {
        $connection = $this->getConnection();
        $users = UserQueries::getAllUsers($connection);
        $newUser = ["email"=>Post::get("user_name"), "password"=>Post::get("password")];
        //TODO: if user picture will be used, then handle it
//        if ($newUser)
//        $this->view("registrationPage", ["errorMessage"=>"Wrong Data!"]);
        UserQueries::addUser($connection, $newUser['email'], $newUser['password']);
    }
}
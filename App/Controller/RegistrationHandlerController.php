<?php


namespace App\Controller;


use App\Queries\UserQueries;
use BK_Framework\SuperGlobal\Post;
use BK_Framework\SuperGlobal\Session;

class RegistrationHandlerController extends BaseController
{
    public function run()
    {
        $connection = $this->getConnection();
        $newUser = ["email"=>Post::get("email"), "password"=>Post::get("password")];
        //$test = filter_input(INPUT_POST, Post::get('user_name'), FILTER_SANITIZE_SPECIAL_CHARS);
        //TODO: if user picture will be used, then handle it

        if ($this->registrationValidation($connection, $newUser)) {
            $hashedPassword = password_hash($newUser['password'], PASSWORD_DEFAULT);
            UserQueries::addUser($connection, $newUser['email'], $hashedPassword);
            header("Location: " . '/');
        } else {
            $this->view("registrationPage", ["errorMessage"=>"Already registered!"]);
        }

    }

    private function registrationValidation($connection, $newUser) : bool {
        $users = UserQueries::getAllUsers($connection);
        $userEmails = array();
        foreach ($users as $user) {
            $userEmails[] = $user->get('email');
        }
        // TODO shall we do more checking?
        return !in_array($newUser['email'], $userEmails, true);
    }
}
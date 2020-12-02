<?php


namespace App\Controller;


use App\Queries\UserQueries;
use BK_Framework\SuperGlobal\Post;


/**
 * Class RegistrationHandlerController
 * @package App\Controller
 */
class RegistrationHandlerController extends BaseController
{
    /**
     *
     */
    public function run()
    {
        $connection = $this->getConnection();
        $newUser = ["email"=>Post::get("email"), "password"=>Post::get("password")];

        if ($this->registrationValidation($connection, $newUser)) {
            $hashedPassword = password_hash($newUser['password'], PASSWORD_DEFAULT);
            UserQueries::addUser($connection, $newUser['email'], $hashedPassword);
            header("Location: " . '/login');
        } else {
            $this->view("registrationPage", ["errorMessage"=>"Already registered!"]);
        }

    }

    /**
     * @param $connection
     * @param $newUser
     * @return bool
     */
    private function registrationValidation($connection, $newUser) : bool {
        $users = UserQueries::getAllUsers($connection);
        $userEmails = array();
        foreach ($users as $user) {
            $userEmails[] = $user->get('email');
        }
        return !in_array($newUser['email'], $userEmails, true);
    }
}
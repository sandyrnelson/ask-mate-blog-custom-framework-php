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
    private string $errorMessage;
    /**
     *
     */
    public function run()
    {
        $connection = $this->getConnection();
        $newUser = ["email"=>Post::get("email"), "password"=>Post::get("password"), "confirm"=>Post::get('confirm')];
        if ($this->registrationValidation($connection, $newUser)) {
            if ($newUser['password'] !== $newUser['confirm']) {
                $this->errorMessage = "Password and Confirmation doesn't match";
            } else {
                $hashedPassword = password_hash($newUser['password'], PASSWORD_DEFAULT);
                UserQueries::addUser($connection, $newUser['email'], $hashedPassword);
                header("Location: " . '/login');
            }
        }

        $this->view("registrationPage", ["errorMessage"=>$this->errorMessage]);

    }

    /**
     * @param $connection
     * @param $newUser
     * @return bool
     */
    private function registrationValidation($connection, $newUser) : bool {
        if (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/", $newUser['email'])) {
            $this->errorMessage = "Invalid username";
            return false;
        }
        $users = UserQueries::getAllUsers($connection);
        $userEmails = array();
        foreach ($users as $user) {
            $userEmails[] = $user->get('email');
        }
        if (!in_array($newUser['email'], $userEmails, true)) {
            return true;
        }

        $this->errorMessage = "Already registered!";
        return false;
    }
}
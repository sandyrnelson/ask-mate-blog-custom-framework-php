<?php


namespace App\Controller;


use App\Queries\UserQueries;
use BK_Framework\Exception\NoSessionException;
use BK_Framework\SuperGlobal\Post;
use BK_Framework\SuperGlobal\Session;

class LoginHandlerController extends BaseController
{
    private string $errormessage = '';
    private ?object $matchingUserData = null;


    /**
     * @throws NoSessionException
     */
    public function run()
    {
        $connection = $this->getConnection();
        $users = UserQueries::getAllUsers($connection);
        $newUser = ["email"=>Post::get("email"), "password"=>Post::get("password")];

        if ($this->loginValidation($users, $newUser)) {

            $newUser = $this->matchingUserData;
            session_start();
            Session::login($newUser->get('id'), $newUser->get('email'));

            $this->view("mainPage", []);
        } else {
            $this->view("loginPage", ["errorMessage"=>$this->errormessage]);
        }

    }


    /**
     * @param $users
     * @param $newUser
     * @return bool
     * @throws NoSessionException
     */
    private function loginValidation($users, $newUser) : bool {

        foreach ($users as $user) {
            if ($user->get('email') === $newUser['email']) {
                if ($this->evaluatePassword($user, $newUser)) {

                    return $this->alreadyLoggedInCheck($user);

                }
                $this->errormessage = 'Wrong password!';
                return false;
            }
        }
        $this->errormessage = 'Invalid username!';
        return false;
    }

    private function evaluatePassword($user, $newUser) : bool {
        $existingUserHashedPassword = $user->get('password_hash');
        return password_verify($newUser['password'], $existingUserHashedPassword);
    }

    /**
     * @param $user
     * @return bool
     * @throws NoSessionException
     */
    private function alreadyLoggedInCheck($user): bool
    {
        if (Session::isSessionExists() && Session::get('id') === $user->get('id')) {
            $this->errormessage = 'Already logged in!';
            return false;
        }
        $this->matchingUserData = $user;
        return true;
    }



}
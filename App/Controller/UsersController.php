<?php


namespace App\Controller;


use App\Queries\UserQueries;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $usersFromDB = UserQueries::getUsersWithDetails($connection);

        $users = $this->getArraysOfRecords($usersFromDB);

        $this->view("users", ['users' => $users]);

    }
}
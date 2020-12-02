<?php


namespace App\Controller;


use App\Queries\UserQueries;

class UsersController extends BaseController
{

    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $usersFromDB = UserQueries::getAllUsers($connection);
        $users = $this->getArraysOfRecords($usersFromDB);
        $this->view("users", ['users' => $users]);

    }
}
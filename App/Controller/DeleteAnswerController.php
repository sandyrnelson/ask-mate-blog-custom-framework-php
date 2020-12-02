<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\TagQueries;

/**
 * Class DeleteAnswerController
 * @package App\Controller
 */
class DeleteAnswerController extends BaseController
{
    /**
     * @var int
     */
    private int $answerId;

    /**
     * DeleteAnswerController constructor.
     * @param $answerId
     */
    public function __construct($answerId)
    {
        parent::__construct();
        $this -> answerId = $answerId;
    }


    /**
     * @return int
     */
    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    /**
     * @return string
     */
    public function run() {
        session_start();
        $id = $this ->getAnswerId();
        $connection = $this->getConnection();
        return AnswerQueries::delete($connection, $id);
    }
}
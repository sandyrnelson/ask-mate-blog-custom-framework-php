<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use App\Queries\RelQuestionTagQueries;


/**
 * Class DeleteQuestionController
 * @package App\Controller
 */
class DeleteQuestionController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;

    /**
     * DeleteQuestionController constructor.
     * @param $id
     */
    public function __construct($id)
    {
        parent::__construct();
        $this -> questionId = $id;
    }

    /**
     * @return int
     */
    public function getQuestionID(): int
    {
        return $this->questionId;
    }

    /**
     *
     */
    public function run() {
        session_start();
        $id = $this ->getQuestionID();
        $connection = $this->getConnection();
        RelQuestionTagQueries::deleteWithQuestion($connection, $id);
        AnswerQueries::deleteWithQuestion($connection, $id);
        QuestionQueries::delete($connection, $id);

    }

}
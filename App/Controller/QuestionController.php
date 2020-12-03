<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\ImageQueries;
use App\Queries\QuestionQueries;
use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;
use App\Queries\UserQueries;

/**
 * Class QuestionController
 * @package App\Controller
 */
class QuestionController extends BaseController
{
    /**
     * @var int
     */
    private int $questionId;

    /**
     * QuestionController constructor.
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
        $connection = $this->getConnection();

        $loggedUser = $this->getLoggedUserId() ? UserQueries::getUserIDBySessionName($connection, $_SESSION['userName']) -> getRecord() : 0;

        $questionDetails = QuestionQueries::getBy($connection, $this ->getQuestionID()) -> getRecord();

        $time = strtotime($questionDetails['submission_time'] );
        $myFormatForView = date("m/d/y", $time);
        $questionDetails['submission_time'] = $myFormatForView;

        $questionOwner = UserQueries::getById($connection, $questionDetails['id_registered_user'])->getRecord();
        $answersByQuestionID = AnswerQueries::getAnswersByQuestionID($connection, $this->getQuestionID());
        $answers = $this -> getArraysOfRecords($answersByQuestionID);
        $tagsRecords = RelQuestionTagQueries::getBy($connection, $questionDetails['id']);
        $tags = $this -> getArraysOfRecords($tagsRecords);

        if ($questionDetails['id_image'] !== null) {
            $imageId = $questionDetails['id_image'];
            $imageName = ImageQueries::getBy($connection, $imageId)->get('file_name');
            $this->view("question", ['question' => $questionDetails, 'answers' => $answers, 'tags' => $tags,
                'questionOwner' => $questionOwner, 'imageName'=>$imageName]);
        } else {
            $this->view("question", ['question' => $questionDetails, 'answers' => $answers, 'tags' => $tags,
                'questionOwner' => $questionOwner]);
        }
    }


}
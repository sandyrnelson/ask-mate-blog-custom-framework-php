<?php


namespace App\Controller;


use App\Queries\TagQueries;
use App\Queries\UserQueries;

/**
 * Class TagController
 * @package App\Controller
 */
class TagPageController extends BaseController
{

    /**
     *
     */
    public function run()
    {
        session_start();

        $connection = $this->getConnection();

        $loggedUser = $this->getLoggedUserId() ? UserQueries::getUserIDBySessionName($connection, $_SESSION['userName']) -> getRecord() : 0;

        $tags = TagQueries::getAll($connection);
        $this->addQuestionCountToTags($tags);
        $this->view("tagPage", ['tags' => $tags, 'loggedUser' => $loggedUser]);

    }

    /**
     * @param $tags
     * @return array
     */
    private function addQuestionCountToTags($tags) : array {
        foreach ($tags as $tag) {
            $tagId = $tag->get('id');
            $questionNumber = TagQueries::getNumberOfQuestion($this->getConnection(), $tagId);
            $tag->setNewProperty('count_questions', $questionNumber);
        }
        return $tags;
    }
}
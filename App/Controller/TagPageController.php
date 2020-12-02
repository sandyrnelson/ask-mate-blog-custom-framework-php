<?php


namespace App\Controller;


use App\Queries\TagQueries;

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
        $connection = $this->getConnection();
        $tags = TagQueries::getAll($connection);
        $this->addQuestionCountToTags($tags);
        $this->view("tagPage", ['tags' => $tags]);

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
<?php


namespace App\Controller;


use App\Queries\TagQueries;

class TagController extends BaseController
{

    public function run()
    {
        $connection = $this->getConnection();
        $tags = TagQueries::getAll($connection);
        $this->addQuestionCountToTags($tags);
        $tagsData = $this->getTagsData($tags);
        $this->view("tagPage", ['tags' => $tagsData]);

    }

    private function getTagsData(array $tags): array
    {
        $result = array();
        foreach ($tags as $tag) {
            $result[] = $tag->getRecord();
        }
        return  $result;
    }

    private function addQuestionCountToTags( $tags) : array {
        foreach ($tags as $tag) {
            $tagId = $tag->get('id');
            $questionNumber = TagQueries::getNumberOfQuestion($this->getConnection(), $tagId);
            $tag->setNewProperty('count_questions', $questionNumber);
        }
        return $tags;
    }
}
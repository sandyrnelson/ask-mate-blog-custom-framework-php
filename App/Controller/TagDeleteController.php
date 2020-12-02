<?php


namespace App\Controller;


use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;

class TagDeleteController extends BaseController
{
    private string $questionId;
    private string $tagname;

    public function __construct(string $questionId, string $tagname)
    {
        parent::__construct();
        $this->questionId = $questionId;
        $this->tagname = $tagname;
    }

    public function run()
    {
        $connection = $this->getConnection();
        $tagId = TagQueries::getByName($connection, $this->tagname)->get('id');
        $tagRelationsWithThisTagId = RelQuestionTagQueries::getTagRelationsByTagId($connection, $tagId);
        $tagRelationToDelete = null;
        foreach ($tagRelationsWithThisTagId as $relations) {
            if ($relations->get('id_question') === $this->questionId) {
                $tagRelationToDelete = $relations->get('id');
            }
        }

        RelQuestionTagQueries::deleteTagQuestionRelation($connection, $tagRelationToDelete);

        if (count($tagRelationToDelete) === 1 && count($tagRelationsWithThisTagId) === 1) {
            TagQueries::deleteTag($connection, $tagId);
        }

        header('Location: ' . '/question/' . $this->questionId);
        exit();
    }
}
<?php


namespace App\Controller;


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
        $tagRelationsWithThisTagId = TagQueries::getTagRelationsByTagId($connection, $tagId);
        $tagRelationToDelete = null;
        foreach ($tagRelationsWithThisTagId as $relations) {
            if ($relations->get('id_question') === $this->questionId) {
                $tagRelationToDelete = $relations->get('id');
            }
        }
        //TODO check, and if empty array, delete from tags - but only if we are in time
        TagQueries::deleteTagQuestionRelation($connection, $tagRelationToDelete);
        header('Location: ' . '/question/' . $this->questionId);
        exit();
    }
}
<?php


namespace App\Controller;


use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;
use PDO;

/**
 * Class TagDeleteController
 * @package App\Controller
 */
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

        $this->deleteRelation($connection, $tagRelationToDelete, $tagRelationsWithThisTagId, $tagId);

        header('Location: ' . '/question/' . $this->questionId);
        exit();
    }

    /**
     * @param PDO $connection
     * @param $tagRelationToDelete
     * @param array $tagRelationsWithThisTagId
     * @param $tagId
     */
    private function deleteRelation(PDO $connection, $tagRelationToDelete, array $tagRelationsWithThisTagId, $tagId): void
    {
        RelQuestionTagQueries::deleteTagQuestionRelation($connection, $tagRelationToDelete);

        $this->deleteOrphanTag($tagRelationToDelete, $tagRelationsWithThisTagId, $connection, $tagId);
    }

    /**
     * @param $tagRelationToDelete
     * @param array $tagRelationsWithThisTagId
     * @param PDO $connection
     * @param $tagId
     */
    private function deleteOrphanTag($tagRelationToDelete, array $tagRelationsWithThisTagId, PDO $connection, $tagId): void
    {
        if (count($tagRelationToDelete) === 1 && count($tagRelationsWithThisTagId) === 1) {
            TagQueries::deleteTag($connection, $tagId);
        }
    }
}
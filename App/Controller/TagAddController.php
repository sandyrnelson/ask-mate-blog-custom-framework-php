<?php


namespace App\Controller;


use App\Queries\RelQuestionTagQueries;
use App\Queries\TagQueries;
use BK_Framework\SuperGlobal\Post;

/**
 * Class TagAddController
 * @package App\Controller
 */
class TagAddController extends BaseController
{
    /**
     * @var string
     */
    private string $questionId;

    /**
     * TagAddController constructor.
     * @param string $questionId
     */
    public function __construct(string $questionId)
    {
        parent::__construct();
        $this->questionId = $questionId;
    }


    /**
     * @param $object
     * @return mixed
     */
    public function arrayMapper($object) {
        return $object->get('name');
    }

    /**
     *
     */
    public function run()
    {
        session_start();
        $connection = $this->getConnection();
        $allTags = TagQueries::getAll($connection);
        if ($_POST) {
            $this->checkQuestionTags($connection, $allTags);
            header("Location: " . '/question/' . $this->questionId);
            exit();
        }

        $this->view("addTagPage", ['tags'=>$allTags, 'questionId'=>$this->questionId]);

    }


    /**
     * @param $connection
     * @param array $allTags
     */
    private function checkQuestionTags($connection, array $allTags): void
    {
        $tagName = Post::get('tag_name');
        $actualQuestionsTags = RelQuestionTagQueries::getBy($connection, $this->questionId);
        if (!in_array($tagName, array_map(array($this, 'arrayMapper'), $actualQuestionsTags), true)) {
            $this->addTagToQuestion($connection, $tagName, $allTags);
        }
    }


    /**
     * @param $connection
     * @param string $tagName
     * @param array $allTags
     */
    private function addTagToQuestion($connection, string $tagName, array $allTags): void
    {
        $this->createNewTag($tagName, $allTags, $connection);
        $tagId = TagQueries::getByName($connection, $tagName);
        RelQuestionTagQueries::addSimple($connection, $this->questionId, $tagId->get('id'));
    }

    /**
     * @param string $tagName
     * @param array $allTags
     * @param $connection
     */
    private function createNewTag(string $tagName, array $allTags, $connection): void
    {
        if (!in_array($tagName, array_map(array($this, 'arrayMapper'), $allTags), true)) {
            TagQueries::addSimple($connection, $tagName);
        }
    }

}
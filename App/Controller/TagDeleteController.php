<?php


namespace App\Controller;


use App\Queries\TagQueries;

class TagDeleteController extends BaseController
{
    private string $questionId;
    private string $tagId;

    public function __construct(string $questionId, string $tagId)
    {
        parent::__construct();
        $this->questionId = $questionId;
        $this->tagId = $tagId;
    }

    public function run()
    {
        $connection = $this->getConnection();
        TagQueries::deleteTagFromQuestion($connection, $this->questionId, $this->tagId);
        header('Location: ' . '/question' . $this->questionId);
        exit();
    }
}
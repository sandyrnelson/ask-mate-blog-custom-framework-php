<?php


namespace App\Controller;


use App\Queries\TagQueries;
use Zend\Code\Generator\DocBlock\Tag;

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
        TagQueries::deleteTagFromQuestion($connection, $this->questionId, $tagId);
        header('Location: ' . '/question/' . $this->questionId);
        exit();
    }
}
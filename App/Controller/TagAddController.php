<?php


namespace App\Controller;


use App\Queries\TagQueries;
use BK_Framework\SuperGlobal\Post;

class TagAddController extends BaseController
{
    private string $questionId;

    public function __construct(string $questionId)
    {
        parent::__construct();
        $this->questionId = $questionId;
    }

    public function run()
    {
        session_start();
        $allTags = TagQueries::getAll($this->getConnection());
        if ($_POST) {
            $tagName = Post::get('tag_name');


        } else {
            $this->view("addTagPage", ['tags'=>$allTags, 'questionId'=>$this->questionId]);
        }

    }
}
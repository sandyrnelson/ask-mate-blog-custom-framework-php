<?php


namespace App\Controller;


use App\Queries\AnswerQueries;
use App\Queries\QuestionQueries;
use BK_Framework\SuperGlobal\Post;

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController extends BaseController
{

    /**
     * @var
     */
    private $searchText;

    /**
     * SearchController constructor.
     */
    public function __construct()
	{
		parent::__construct();
	}

    /**
     * @return string
     */
    public function getSearchText(): string
    {
        return $this->searchText;
    }

    /**
     *
     */
    public function run() {
        session_start();
        $this->searchText = Post::get("search");
        $connection = $this->getConnection();
        $questionsFromDB = QuestionQueries::search($connection, $this->getSearchText() );
        $questions = array();
        foreach ($questionsFromDB as $question) {
            $record['id'] = $question -> get('id');
            $record['title'] = $this->highlightKeywords($question -> get('title'));
            $record['message'] = $this->highlightKeywords($question -> get('message'));
            $answersDB = AnswerQueries::search($connection, $question -> get('id'),  $this->getSearchText());
            $answers = array();
            foreach ($answersDB as $answer){
                $recordAnswer['answerMessage'] = $this->highlightKeywords($answer -> get('message'));
                array_push($answers, $recordAnswer);
            }
            $record['answers'] = $answers;
            array_push($questions, $record);
        }
//        var_dump($questions);
		$this->view('search', ['questions'=>$questions]);
	}

    /**
     * @param $text
     * @return string|string[]
     */
    function highlightKeywords($text) {
        $keyword = $this->getSearchText();
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);

        for($i=0;$i<$wordsCount;$i++) {
            $highlighted_text = "<span class='highlight' style='font-weight:bold;'>$wordsAry[$i]</span>";
            $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
        }

        return $text;
    }
}

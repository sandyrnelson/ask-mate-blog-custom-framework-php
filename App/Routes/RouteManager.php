<?php


namespace App\Routes;


class RouteManager
{

	public static function init(): void
    {

		GetRoutes::init();
		OtherRoutes::init();
        UserRelatedRoutes::init();
		AskQuestionRoutes::init();
		AnswerRoutes::init();

	}

}

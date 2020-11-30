<?php


namespace App\Controller;


use App\Queries\BandQueries;



class ListController extends BaseController
{

	public function run() {
		$connection = $this->getConnection();
		$bands = BandQueries::getAll($connection);
		$this->view("search", ["bands"=>$bands]);
	}
}

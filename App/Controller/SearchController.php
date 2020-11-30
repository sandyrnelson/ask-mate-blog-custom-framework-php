<?php


namespace App\Controller;


use App\Queries\BandQueries;
use BK_Framework\Logger\Logger;

class SearchController extends BaseController
{

	private int $id;

	/**
	 * SearchController constructor.
	 * @param int $id
	 */
	public function __construct(int $id)
	{
		parent::__construct();
		$this->id = $id;
	}

	public function run() {
		$connection = $this->getConnection();
		$band = BandQueries::getBy($connection, $this->id);
		Logger::getInstance()->emergency("Found new record");
		echo $band->get('name');
	}
}

<?php


namespace App\Controller;


use App\Queries\BandQueries;

class InsertController extends BaseController
{

	private string $name;

	/**
	 * InsertController constructor.
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		parent::__construct();
		$this->name = $name;
	}

	public function run()
	{
		$connection = $this->getConnection();
		$id = BandQueries::addSimple($connection, $this->name);
		echo "New id: $id";
	}
}

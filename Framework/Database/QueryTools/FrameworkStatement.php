<?php


namespace BK_Framework\Database\QueryTools;


use PDO;
use PDOStatement;

/**
 * Class FrameworkStatement
 *
 * Custom class for database operation extending PDO/Statement class.
 *
 * @package BK_Framework\Database\QueryTools
 */
class FrameworkStatement extends PDOStatement
{

	/**
	 * FrameworkStatement constructor.
	 * Sets fetching mode to an associative array-type which is utilized for creating
	 * ResultSet instances.
	 */
	protected function __construct()
	{
		$this->setFetchMode(PDO::FETCH_ASSOC);
	}

	/**
	 * Obtains data from the database in a form of an associative array and creates
	 * a ResultSet-instance therefrom.
	 *
	 * @param $fetch_style
	 * @param int $cursor_orientation
	 * @param int $cursor_offset
	 * @return ResultSet|mixed
	 */
	public function fetch($fetch_style = null, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0)
	{
		$record = parent::fetch($fetch_style, $cursor_orientation, $cursor_offset);
		return new ResultSet($record);
	}

	/**
	 * Obtains data from the database in a form of associative arrays and creates
	 * a ResultSet-instance from each of them.
	 *
	 * @param $how
	 * @param $class_name
	 * @param $ctor_args
	 * @return array|ResultSet[]
	 * @noinspection PhpSignatureMismatchDuringInheritanceInspection
	 */
	public function fetchAll($how = NULL, $class_name = NULL, $ctor_args = NULL)
	{
		$records = parent::fetchAll();
		return array_map(function ($record) { return new ResultSet($record); }, $records);
	}


}

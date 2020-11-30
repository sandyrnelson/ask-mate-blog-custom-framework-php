<?php


namespace BK_Framework\Database\QueryTools;


use PDO;

/**
 * Class FrameworkPDO
 *
 * Custom class for database operation extending PDO class.
 *
 * @package BK_Framework\Database\QueryTools
 */
class FrameworkPDO extends PDO
{

	/**
	 * BK_Framework_PDO constructor.
	 *
	 * Behaves similar to parent class except it sets the returned Statement-class
	 * to FrameworkStatement as default. Constructor parameters are required elements
	 * of the connection string.
	 *
	 * @param string|null $user
	 * @param string|null $password
	 * @param string|null $host
	 * @param string|null $db
	 */
	public function __construct(string $user = null, string $password = null, string $host = null, string $db = null)
	{
		parent::__construct("mysql:host=".$host.";dbname=".$db, $user, $password);
		$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('BK_Framework\Database\QueryTools\FrameworkStatement', array($this)));
	}
}
